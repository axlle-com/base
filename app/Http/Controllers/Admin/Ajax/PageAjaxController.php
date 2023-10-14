<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Requests\Admin\Page\StorePageRequest;
use App\Http\Requests\Admin\Page\UpdatePageRequest;
use App\Services\Blog\Page\PageServices;
use App\Services\Render\RenderServices;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use Throwable;

class PageAjaxController extends AjaxController
{
    private PageServices $pageServices;
    private RenderServices $renderServices;
    private UserServices $userServices;

    /**
     * @param PageServices $pageServices
     * @param RenderServices $renderServices
     * @param UserServices $userServices
     */
    public function __construct(PageServices $pageServices, RenderServices $renderServices, UserServices $userServices)
    {
        $this->pageServices = $pageServices;
        $this->renderServices = $renderServices;
        $this->userServices = $userServices;
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
     * @param StorePageRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StorePageRequest $request): JsonResponse
    {
        if ($model = $this->pageServices->create($request->all())) {
            $data['view'] = view('admin.blog.page_update', [
                'title' => 'Редактирование страницы',
                'model' => $model,
                'renders' => $this->renderServices->get(),
                'menu' => null,
            ])->renderSections()['content'];
            $data['url'] = route('admin.page.edit', ['page' => $model->id]);

            return $this->setData($data)->response();
        }

        return $this->error();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePageRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UpdatePageRequest $request, int $id): JsonResponse
    {
        if ($model = $this->pageServices->update($id, $request->all())) {
            $data['view'] = view('admin.blog.page_update', [
                'title' => 'Редактирование поста',
                'model' => $model,
                'renders' => $this->renderServices->get(),
                'menu' => null,
            ])->renderSections()['content'];

            return $this->setData($data)->response();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
