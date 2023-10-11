<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Request;
use App\Models\Post\Post;
use App\Services\Post\PostServices;
use App\Services\PostCategory\PostCategoryServices;
use App\Services\Render\RenderServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    private PostServices $postServices;
    private RenderServices $renderServices;
    private PostCategoryServices $postCategoryServices;

    /**
     * @param PostServices $postServices
     * @param RenderServices $renderServices
     * @param PostCategoryServices $postCategoryServices
     */
    public function __construct(
        PostServices $postServices,
        RenderServices $renderServices,
        PostCategoryServices $postCategoryServices
    ) {
        $this->postServices = $postServices;
        $this->renderServices = $renderServices;
        $this->postCategoryServices = $postCategoryServices;
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
            'models' => $this->postServices->filter($request->all()),
            'postCategory' => $this->postCategoryServices->get(),
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

        return view('admin.blog.post_update', [
            'title' => $title,
            'model' => new Post(),
            'postCategory' => $this->postCategoryServices->get(),
            'render' => $this->renderServices->get(),
            'menu' => null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit(int $id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $title = 'Редактирование поста';

        return view('admin.blog.post_update', [
            'title' => $title,
            'model' => $this->postServices->find($id),
            'postCategory' => $this->postCategoryServices->get(),
            'render' => $this->renderServices->get(),
            'menu' => null,
        ]);
    }
}
