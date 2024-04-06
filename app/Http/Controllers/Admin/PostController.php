<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Request;
use App\Models\Post\Post;
use App\Services\Blog\InfoBlock\InfoBlockServices;
use App\Services\Blog\Post\PostServices;
use App\Services\Blog\PostCategory\PostCategoryServices;
use App\Services\Render\RenderServices;
use App\Services\UserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    private PostServices $postServices;
    private RenderServices $renderServices;
    private PostCategoryServices $postCategoryServices;
    private UserServices $userServices;
    private InfoBlockServices $infoBlockServices;

    /**
     * @param PostServices $postServices
     * @param RenderServices $renderServices
     * @param PostCategoryServices $postCategoryServices
     * @param UserServices $userServices
     * @param InfoBlockServices $infoBlockServices
     */
    public function __construct(
        PostServices $postServices,
        RenderServices $renderServices,
        PostCategoryServices $postCategoryServices,
        UserServices $userServices,
        InfoBlockServices $infoBlockServices
    ) {
        $this->postServices = $postServices;
        $this->renderServices = $renderServices;
        $this->postCategoryServices = $postCategoryServices;
        $this->userServices = $userServices;
        $this->infoBlockServices = $infoBlockServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $title = 'Список статей';

        return view('admin.blog.post_index', [
            'title' => $title,
            'models' => $this->postServices->filter($request->all()),
            'postCategories' => $this->postCategoryServices->get(),
            'renders' => $this->renderServices->get(Post::table()),
            'users' => $this->userServices->get(),
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

        # TODO: разделить view
        return view('admin.blog.post_update', [
            'title' => $title,
            'model' => null,
            'postCategories' => $this->postCategoryServices->get(),
            'renders' => $this->renderServices->get(Post::table()),
            'infoBlocks' => $this->infoBlockServices->get(),
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
            'postCategories' => $this->postCategoryServices->get(),
            'renders' => $this->renderServices->get(Post::table()),
            'infoBlocks' => $this->infoBlockServices->get(),
            'menu' => null,
        ]);
    }
}
