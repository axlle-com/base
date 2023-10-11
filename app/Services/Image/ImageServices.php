<?php

namespace App\Services\Image;

use App\Models\BaseModel;
use App\Models\Gallery\Gallery;
use App\Models\Page\Page;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageServices
{
    /**
     * @param UploadedFile $file
     * @param string $dir
     * @return string
     */
    public function load(UploadedFile $file, string $dir): string
    {
        $path = public_path($dir);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $url = Str::random(40) . '.' . $file->extension();
        $filename = $path . '/' . $url;
        move_uploaded_file($file->getPathname(), $filename);

        return $dir . '/' . $url;
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function deleteAnyImage(array $attributes): bool
    {
        /**
         * @var $model PostCategory|Post|Page|Gallery
         * @var $db PostCategory|Post|Page|Gallery
         */
        $model = BaseModel::className($attributes['model']);
        if ($model && $db = $model::query()->find($attributes['id'])) {
            return $db->deleteImage();
        }

        return false;
    }

}
