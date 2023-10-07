<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Request;
use App\Repositories\Interfaces\IPostCategoryRepository;
use App\Repositories\Interfaces\IPostRepository;
use App\Repositories\Interfaces\IRenderRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    private IPostRepository $postRepo;
    private IPostCategoryRepository $postCategoryRepo;
    private IRenderRepository $renderRepo;

    /**
     * @param IPostRepository $postRepo
     * @param IPostCategoryRepository $postCategoryRepo
     * @param IRenderRepository $renderRepo
     */
    public function __construct(
        IPostRepository $postRepo,
        IPostCategoryRepository $postCategoryRepo,
        IRenderRepository $renderRepo
    ) {
        $this->postRepo = $postRepo;
        $this->postCategoryRepo = $postCategoryRepo;
        $this->renderRepo = $renderRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $title = 'Список постов';

        return view('admin.blog.post_index', [
            'title' => $title,
            'models' => $this->postRepo->filter(),
            'postCategory' => $this->postCategoryRepo->all(),
            'post' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $title = 'Новый пост';

        return view('admin.blog.post_update.blade', [
            'title' => $title,
            'models' => $this->postRepo->filter(),
            'postCategory' => $this->postCategoryRepo->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(int $id): \Illuminate\Foundation\Application|View|Factory|Application
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $title = 'Редактирование поста';

        return view('admin.blog.post_update', [
            'title' => $title,
            'model' => $this->postRepo->find($id),
            'postCategory' => $this->postCategoryRepo->all(),
            'render' => $this->renderRepo->all(),
            'menu' => null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
