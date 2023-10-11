<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Services\GalleryImage\GalleryImageServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryImageAjaxController extends AjaxController
{
    private GalleryImageServices $galleryImageServices;

    /**
     * @param GalleryImageServices $galleryImageServices
     */
    public function __construct(GalleryImageServices $galleryImageServices)
    {
        $this->galleryImageServices = $galleryImageServices;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        if ($this->galleryImageServices->delete($id)) {
            return $this->response();
        }

        return $this->error();
    }
}
