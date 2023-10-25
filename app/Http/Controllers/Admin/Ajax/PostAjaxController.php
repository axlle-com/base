<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Models\Post\Post;
use App\Services\Blog\InfoBlock\InfoBlockServices;
use App\Services\Blog\Post\PostServices;
use App\Services\Blog\PostCategory\PostCategoryServices;
use App\Services\Render\RenderServices;
use Illuminate\Http\JsonResponse;
use Throwable;

class PostAjaxController extends AjaxController
{
    private PostServices $postServices;
    private RenderServices $renderServices;
    private PostCategoryServices $postCategoryServices;
    private InfoBlockServices $infoBlockServices;

    /**
     * @param PostServices $postServices
     * @param RenderServices $renderServices
     * @param PostCategoryServices $postCategoryServices
     * @param InfoBlockServices $infoBlockServices
     */
    public function __construct(
        PostServices $postServices,
        RenderServices $renderServices,
        PostCategoryServices $postCategoryServices,
        InfoBlockServices $infoBlockServices
    ) {
        $this->postServices = $postServices;
        $this->renderServices = $renderServices;
        $this->postCategoryServices = $postCategoryServices;
        $this->infoBlockServices = $infoBlockServices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        if ($model = $this->postServices->create($request->all())) {
            $data['view'] = view('admin.blog.post_update', [
                'title' => 'Редактирование поста',
                'model' => $model,
                'postCategories' => $this->postCategoryServices->get(),
                'renders' => $this->renderServices->get(Post::table()),
                'infoBlocks' => $this->infoBlockServices->get(),
                'menu' => null,
            ])->renderSections()['content'];
            $data['url'] = route('admin.post.edit', ['post' => $model->id]);

            return $this->setData($data)->response();
        }

        return $this->error();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UpdatePostRequest $request, int $id): JsonResponse
    {
        if ($model = $this->postServices->update($id, $request->all())) {
            $data['view'] = view('admin.blog.post_update', [
                'title' => 'Редактирование поста',
                'model' => $model,
                'postCategories' => $this->postCategoryServices->get(),
                'renders' => $this->renderServices->get(Post::table()),
                'infoBlocks' => $this->infoBlockServices->get(),
                'menu' => null,
            ])->renderSections()['content'];

            return $this->setData($data)->response();
        }

        return $this->error();
    }
}
