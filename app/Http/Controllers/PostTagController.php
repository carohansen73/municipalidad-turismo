<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostTagRequest;
use App\Http\Requests\UpdatePostTagRequest;
use App\Repositories\PostTagRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Flash;
use Response;

class PostTagController extends AppBaseController
{
    /** @var  PostTagRepository */
    private $postTagRepository;

    public function __construct(PostTagRepository $postTagRepo)
    {
        $this->postTagRepository = $postTagRepo;
    }

    /**
     * Display a listing of the PostTag.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $postTags = $this->postTagRepository->all();

        return view('panel.post_tags.index')
            ->with('postTags', $postTags);
    }

    /**
     * Show the form for creating a new PostTag.
     *
     * @return Response
     */
    public function create()
    {
        return view('panel.post_tags.create');
    }

    /**
     * Store a newly created PostTag in storage.
     *
     * @param CreatePostTagRequest $request
     *
     * @return Response
     */
    public function store(CreatePostTagRequest $request)
    {
        $input = $request->all();

        $postTag = $this->postTagRepository->create($input);

        Flash::success('Tag guardado con éxito.');

        return redirect(route('posts.tags.index'));
    }

    /**
     * Display the specified PostTag.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $postTag = $this->postTagRepository->find($id);

        if (empty($postTag)) {
            Flash::error('Tag no encontrado.');

            return redirect(route('posts.tags.index'));
        }

        return view('panel.post_tags.show')->with('postTag', $postTag);
    }

    /**
     * Show the form for editing the specified PostTag.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $postTag = $this->postTagRepository->find($id);

        if (empty($postTag)) {
            Flash::error('Tag no encontrado.');

            return redirect(route('posts.tags.index'));
        }

        return view('panel.post_tags.edit')->with('postTag', $postTag);
    }

    /**
     * Update the specified PostTag in storage.
     *
     * @param int $id
     * @param UpdatePostTagRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostTagRequest $request)
    {
        $postTag = $this->postTagRepository->find($id);

        if (empty($postTag)) {
            Flash::error('Tag no encontrado.');

            return redirect(route('posts.tags.index'));
        }

        $postTag = $this->postTagRepository->update($request->all(), $id);

        Flash::success('Tag actualizado con éxito.');

        return redirect(route('posts.tags.index'));
    }

    /**
     * Remove the specified PostTag from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $postTag = $this->postTagRepository->find($id);

        if (empty($postTag)) {
            Flash::error('Tag no encontrado.');

            return redirect(route('posts.tags.index'));
        }

        $this->postTagRepository->delete($id);

        Flash::success('Tag eliminado con éxito.');

        return redirect(route('posts.tags.index'));
    }

    public function allNews($slug)
    {
        $tag = PostTag::whereSlug($slug)->first();
        if ($tag != null) {
            $posts = $tag->postPublished()->orderBy('publication_date', 'DESC')->paginate(12);

            $title = 'Noticias del tag: ' . $tag->name;
        } else {
            abort(404);
        }
        

        return view('front.news', compact('posts', 'title'));
    }
}
