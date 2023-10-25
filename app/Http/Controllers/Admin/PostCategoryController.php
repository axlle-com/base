<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCategory\StorePostCategoryRequest;
use App\Http\Requests\Admin\PostCategory\UpdatePostCategoryRequest;
use App\Http\Requests\Admin\Request;
use App\Models\Post\PostCategory;
use App\Services\Blog\Post\PostServices;
use App\Services\Blog\PostCategory\PostCategoryServices;
use App\Services\Render\RenderServices;
use App\Services\UserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PostCategoryController extends Controller
{
    private PostServices $postServices;
    private RenderServices $renderServices;
    private PostCategoryServices $postCategoryServices;
    private UserServices $userServices;

    /**
     * @param PostServices $postServices
     * @param RenderServices $renderServices
     * @param PostCategoryServices $postCategoryServices
     * @param UserServices $userServices
     */
    public function __construct(
        PostServices $postServices,
        RenderServices $renderServices,
        PostCategoryServices $postCategoryServices,
        UserServices $userServices
    ) {
        $this->postServices = $postServices;
        $this->renderServices = $renderServices;
        $this->postCategoryServices = $postCategoryServices;
        $this->userServices = $userServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $title = 'Список категорий';

        return view('admin.blog.category_index', [
            'title' => $title,
            'models' => $this->postCategoryServices->filter($request->all()),
            'postCategories' => $this->postCategoryServices->get(),
            'renders' => $this->renderServices->get(PostCategory::table()),
            'users' => $this->userServices->get(),
            'post' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Новая категория';

        # TODO: разделить view
        return view('admin.blog.category_update', [
            'title' => $title,
            'model' => null,
            'postCategories' => $this->postCategoryServices->get(),
            'renders' => $this->renderServices->get(PostCategory::table()),
            'menu' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(int $id): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $title = 'Редактирование категории';

        # TODO: разделить view
        return view('admin.blog.category_update', [
            'title' => $title,
            'model' => $this->postCategoryServices->find($id),
            'postCategories' => $this->postCategoryServices->get(),
            'renders' => $this->renderServices->get(PostCategory::table()),
            'menu' => null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostCategoryRequest $request, int $id)
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
