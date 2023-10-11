<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Services\Image\ImageServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageAjaxController extends AjaxController
{
    private ImageServices $imageServices;

    /**
     * @param \App\Services\Image\ImageServices $imageServices
     */
    public function __construct(ImageServices $imageServices)
    {
        $this->imageServices = $imageServices;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function delete(Request $request, int $id): JsonResponse
    {
        $post = $request->all();
        $post['id'] = $id;
        if ($this->imageServices->deleteAnyImage($post)) {
            return $this->response();
        }

        return $this->error();
    }
}
