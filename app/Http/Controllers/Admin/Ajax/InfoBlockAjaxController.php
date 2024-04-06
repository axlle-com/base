<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Requests\Admin\Page\StorePageRequest;
use App\Http\Requests\Admin\Page\UpdatePageRequest;
use App\Models\Page\Page;
use App\Services\Blog\InfoBlock\InfoBlockServices;
use App\Services\Render\RenderServices;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use Throwable;

class InfoBlockAjaxController extends AjaxController
{
    private InfoBlockServices $infoBlockServices;
    private RenderServices $renderServices;
    private UserServices $userServices;

    /**
     * @param InfoBlockServices $infoBlockServices
     * @param RenderServices $renderServices
     * @param UserServices $userServices
     */
    public function __construct(
        InfoBlockServices $infoBlockServices,
        RenderServices $renderServices,
        UserServices $userServices
    ) {
        $this->infoBlockServices = $infoBlockServices;
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
        if ($model = $this->infoBlockServices->create($request->all())) {
            $data['view'] = view('admin.info_block.update', [
                'title' => 'Редактирование страницы',
                'model' => $model,
                'renders' => $this->renderServices->get(Page::table()),
            ])->renderSections()['content'];
            $data['url'] = route('admin.info-block.edit', ['info_block' => $model->id]);

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
        if ($model = $this->infoBlockServices->update($id, $request->all())) {
            $data['view'] = view('admin.info_block.update', [
                'title' => 'Редактирование поста',
                'model' => $model,
                'renders' => $this->renderServices->get(Page::table()),
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

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function getForResource(int $id): JsonResponse
    {
        if ($model = $this->infoBlockServices->find($id)) {
            $data['view'] = view('admin.inc.info_block_one', [
                'infoBlock' => $model,
            ])->render();

            return $this->setData($data)->response();
        }

        return $this->error();
    }
}
