<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\PostRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Post;
use App\Models\PostGaleryImage;
use App\Models\PostTag;
use Image;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->all();
        $title = 'Listado de Posts';
        return view('panel.posts.index')
            ->with('title', $title)
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        $post_categories = PostCategory::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $post_tags = PostTag::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $my_tags = null;
        return view('panel.posts.create', compact('post_categories', 'post_tags', 'my_tags'));
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = new Post($request->all());
        if ($request->hasFile('important_image')) {
            $post->important_image = $this->uploadFileImportantImage($request);
        }
        $post->user_id = \Auth::user()->id;
        $post->save();

        $post->tags()->sync($request->post_tag_id);

        if ($request->hasFile('galery')) {
            if (count($request->galery) <= 9) {
                $this->uploadImagesToGallery($request, $post);
            } else {
                Flash::warning('No se pueden agregar más de 9 imágenes en la galería.');
            }
        }

        Flash::success('Post guardado con éxito.');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post no encontrado.');

            return redirect(route('posts.index'));
        }

        return view('panel.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post no encontrado.');

            return redirect(route('posts.index'));
        }
        $post_categories = PostCategory::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $post_tags = PostTag::orderBy('name', 'ASC')->pluck('name', 'id')->all();

        $my_tags = $post->tags->pluck('id')->toArray();

        return view('panel.posts.edit')->with('post', $post)->with('post_categories', $post_categories)->with('post_tags', $post_tags)->with('my_tags', $my_tags);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param int $id
     * @param UpdatePostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = Post::findOrFail($id);
        if (empty($post)) {
            Flash::error('Post no encontrado.');

            return redirect(route('posts.index'));
        }
        if ($request->hasFile('important_image')) {
            $this->deleteFileImportantImage($post);
            $post->important_image = $this->uploadFileImportantImage($request);
        }
        $post->title = $request->title;
        $post->summary = $request->summary;
        $post->publication_date = $request->publication_date;
        $post->content = $request->content;
        $post->user_id = \Auth::user()->id;
        $post->post_category_id = $request->post_category_id;
        $post->publish = $request->publish;
        $post->signature_author = $request->signature_author;
        $post->save();

        $post->tags()->sync($request->post_tag_id);

        if ($request->hasFile('galery')) {
            if (($post->galeryImages->count() + count($request->galery)) <= 9) {
                $this->uploadImagesToGallery($request, $post);
            } else {
                Flash::warning('El post ya posee 9 imágenes en su galería, elimine algunas si desea agregar nuevas.');
            }
        }

        Flash::success('Post actualizado con éxito.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post no encontrado.');

            return redirect(route('posts.index'));
        }

        $this->postRepository->delete($id);

        Flash::success('Post enviado a la papelera con éxito.');

        return redirect(route('posts.index'));
    }

    public function uploadFileImportantImage($request)
    {
        // get file extension
        $extension = $request->file('important_image')->getClientOriginalExtension();
        // filename to store
        $filenametostore = str_slug($request->title . '-' . time()) . '.' . $extension;
        // Upload File
        $request->file('important_image')->storeAs('public/posts', $filenametostore);
        // Resize image here
        $important_imagepath = public_path('storage/posts/' . $filenametostore);
        // create a cached image and set a lifetime and return as object instead of string
        $img = Image::cache(function ($important_image) use ($filenametostore) {
            $important_image->make('storage/posts/' . $filenametostore)->fit(750, 450);
        }, 10, true);
        $img->save($important_imagepath);
        return $filenametostore;
    }

    public function deleteFileImportantImage($post)
    {
        if (\File::exists(public_path() . '/storage/posts/' . $post->important_image)) {
            \File::delete(public_path() . '/storage/posts/' . $post->important_image);
        } else {
            \Alert::message('¡La imagen destacada no existe!', 'danger');
        }
    }

    /**
     * Get the trash can with all the deleted posts
     */
    public function trash()
    {
        $posts = Post::onlyTrashed()->get();
        $title = 'Posts en papelera';
        return view('panel.posts.index')
            ->with('posts', $posts)
            ->with('title', $title);
    }

    /**
     * Remove the selected post permanently
     */
    public function trashDelete($id)
    {
        try {
            $post = Post::onlyTrashed()->where('id', $id)->firstOrFail();
            $this->deleteFileImportantImage($post);
            foreach ($post->galeryImages as $galeryImage) {
                $this->deleteFileGaleryImage($galeryImage);
            }
            $post->forceDelete();
            Flash::success('Post eliminado definitivamente con éxito.');
            return redirect()->route('posts.trash');
        } catch (\Exception $e) {
            Flash::error('El post tiene referencias en otra/s tabla/s por eso no será eliminado definitivamente. Si desea hacerlo primero debe quitar dichas referencias.');
            return redirect()->route('posts.trash');
        }
    }

    /**
     * Restore the selected product
     */
    public function restore($id)
    {
        // Indicamos que la busqueda se haga en los registros eliminados con withTrashed
        $post = Post::withTrashed()->where('id', $id)->first();
        // Restauramos el registro
        $post->restore();
        Flash::success('El post fue restaurado con éxito.');
        return redirect()->route('posts.index');
    }

    public function news()
    {
        $posts = Post::where('publish', 1)->orderBy('publication_date', 'DESC')->paginate(12);
        $title = 'Todas las noticias';
        return view('front.news', compact('posts', 'title'));
    }

    public function singleNew($category_slug, $new_slug)
    {
        $post = Post::where('slug', $new_slug)->where('publish', 1)->firstOrFail();
        $prev_post = $this->previousPost($post);
        $next_post = $this->nextPost($post);

        $categories = PostCategory::where('publish', 1)->get();
        $tags = PostTag::where('publish', 1)->get();
        $recentPosts = Post::where('publish', 1)->orderBy('publication_date', 'DESC')->get()->take(3);

        return view('front.single-new', compact('post', 'prev_post', 'next_post', 'categories', 'tags', 'recentPosts'));
    }

    /*
    *   return the previous post
    */
    public function previousPost($post)
    {
        $previous = Post::where('id', '<', $post->id)->where('publish', 1)->orderBy('id','desc')->first();

        if ($previous == null) {
            $previous = Post::where('publish', 1)->orderBy('id', 'desc')->first();
        }

        return $previous;
    }

    /*
    *   return the next post
    */
    public function nextPost($post)
    {
        $next = Post::where('id', '>', $post->id)->where('publish', 1)->orderBy('id')->first();

        if ($next == null) {
            $next = Post::where('publish', 1)->orderBy('id', 'ASC')->first();
        }

        return $next;
    }

    public function searchNew(Request $request)
    {
        $search = $request->search;

        $posts = Post::search($search)->where('publish', 1)->orderBy('publication_date', 'DESC')->paginate(12);
        $title = 'Resultados de la busqueda: ' . $search;
        return view('front.news', compact('posts', 'title'));
    }

    /**
     * Upload image files to the post gallery and add it to its corresponding table
     */
    public function uploadImagesToGallery(Request $request, Post $post)
    {
        $galery = $request->galery;
        $i = 0;
        foreach ($galery as $file) {
            // filename to store
            $filenametostore = str_slug(substr($post->title, 0, 50) . '-' . $i . '-' . time()) . '.' . $file->getClientOriginalExtension();
            // Upload File
            $file->storeAs('public/post_galery', $filenametostore);
            // Resize image here
            $image_path = public_path('storage/post_galery/' . $filenametostore);
            // create a cached image and set a lifetime and return as object instead of string
            $img = Image::cache(function ($image) use ($filenametostore) {
                $image->make('storage/post_galery/' . $filenametostore)->fit(750, 450);
            }, 10, true);
            $img->save($image_path);

            $post_galery_image = new PostGaleryImage();
            $post_galery_image->image = $filenametostore;
            $post_galery_image->post_id = $post->id;
            $post_galery_image->save();

            $i = $i + 1;
        }
    }

    public function deleteFileGaleryImage($galeryImage)
    {
        if (\File::exists(public_path() . '/storage/post_galery/' . $galeryImage->image)) {
            \File::delete(public_path() . '/storage/post_galery/' . $galeryImage->image);
        } else {
            \Alert::message('¡La imagen de la galería no existe!', 'danger');
        }
    }
}
