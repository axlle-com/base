<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Services\Blog\InfoBlock\InfoBlockHasResourceServices;
use Illuminate\Http\JsonResponse;

class InfoBlockHasResourceAjaxController extends AjaxController
{
    private InfoBlockHasResourceServices $infoBlockHasResourceServices;

    /**
     * @param InfoBlockHasResourceServices $infoBlockHasResourceServices
     */
    public function __construct(InfoBlockHasResourceServices $infoBlockHasResourceServices)
    {
        $this->infoBlockHasResourceServices = $infoBlockHasResourceServices;
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if ($this->infoBlockHasResourceServices->delete($id)) {
            return $this->response();
        }

        return $this->error();
    }
}
