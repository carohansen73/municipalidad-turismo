<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Repositories\PostCategoryRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Flash;
use Response;

class PostCategoryController extends AppBaseController
{
    /** @var  PostCategoryRepository */
    private $postCategoryRepository;

    public function __construct(PostCategoryRepository $postCategoryRepo)
    {
        $this->postCategoryRepository = $postCategoryRepo;
    }

    /**
     * Display a listing of the PostCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $postCategories = $this->postCategoryRepository->all();

        return view('panel.post_categories.index')
            ->with('postCategories', $postCategories);
    }

    /**
     * Show the form for creating a new PostCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('panel.post_categories.create');
    }

    /**
     * Store a newly created PostCategory in storage.
     *
     * @param CreatePostCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreatePostCategoryRequest $request)
    {
        $input = $request->all();

        $postCategory = $this->postCategoryRepository->create($input);

        Flash::success('Categoría guardada con éxito.');

        return redirect(route('posts.categorias.index'));
    }

    /**
     * Display the specified PostCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('posts.categorias.index'));
        }

        return view('panel.post_categories.show')->with('postCategory', $postCategory);
    }

    /**
     * Show the form for editing the specified PostCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('posts.categorias.index'));
        }

        return view('panel.post_categories.edit')->with('postCategory', $postCategory);
    }

    /**
     * Update the specified PostCategory in storage.
     *
     * @param int $id
     * @param UpdatePostCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostCategoryRequest $request)
    {
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('posts.categorias.index'));
        }

        $postCategory = $this->postCategoryRepository->update($request->all(), $id);

        Flash::success('Categoría actualizada con éxito.');

        return redirect(route('posts.categorias.index'));
    }

    /**
     * Remove the specified PostCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $postCategory = $this->postCategoryRepository->find($id);

        if (empty($postCategory)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('posts.categorias.index'));
        }

        $this->postCategoryRepository->delete($id);

        Flash::success('Categoría eliminada con éxito.');

        return redirect(route('posts.categorias.index'));
    }

    public function allNews($slug)
    {
        $postCategory = PostCategory::whereSlug($slug)->first();
        if ($postCategory != null) {
            $posts = $postCategory->postPublished()->orderBy('publication_date', 'DESC')->paginate(12);

            $title = 'Noticias de la categoría: ' . $postCategory->name;
        } else {
            abort(404);
        }

        return view('front.news', compact('posts', 'title'));
    }
}
