<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Requests\Admin\PostCategory\StorePostCategoryRequest;
use App\Http\Requests\Admin\PostCategory\UpdatePostCategoryRequest;
use App\Models\Post\PostCategory;
use App\Services\Blog\PostCategory\PostCategoryServices;
use App\Services\Render\RenderServices;
use Illuminate\Http\JsonResponse;
use Throwable;

class PostCategoryAjaxController extends AjaxController
{
    private PostCategoryServices $postCategoryServices;
    private RenderServices $renderServices;

    /**
     * @param PostCategoryServices $postCategoryServices
     * @param RenderServices $renderServices
     */
    public function __construct(PostCategoryServices $postCategoryServices, RenderServices $renderServices)
    {
        $this->postCategoryServices = $postCategoryServices;
        $this->renderServices = $renderServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostCategoryRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StorePostCategoryRequest $request): JsonResponse
    {
        if ($model = $this->postCategoryServices->create($request->all())) {
            $data['view'] = view('admin.blog.category_update', [
                'title' => 'Редактирование поста',
                'model' => $model,
                'postCategories' => $this->postCategoryServices->get(),
                'renders' => $this->renderServices->get(PostCategory::table()),
                'menu' => null,
            ])->renderSections()['content'];
            $data['url'] = route('admin.page.edit', ['post_category' => $model->id]);

            return $this->setData($data)->response();
        }

        return $this->error();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostCategoryRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UpdatePostCategoryRequest $request, int $id): JsonResponse
    {
        if ($model = $this->postCategoryServices->update($id, $request->all())) {
            $data['view'] = view('admin.blog.category_update', [
                'title' => 'Редактирование поста',
                'model' => $model,
                'postCategories' => $this->postCategoryServices->get(),
                'renders' => $this->renderServices->get(PostCategory::table()),
                'menu' => null,
            ])->renderSections()['content'];

            return $this->setData($data)->response();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        //
    }
}
