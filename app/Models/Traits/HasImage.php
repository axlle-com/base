<?php

namespace App\Models\Traits;

use App\Models\Gallery\Gallery;
use App\Models\Gallery\GalleryImage;
use App\Models\Page\Page;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;

/**
 * @property string|null $image
 *
 * TODO: вынести в сервис
 */
trait HasImage
{
    /**
     * @return bool
     */
    public function deleteImage(): bool
    {
        /** @var $this PostCategory|Post|Page|Gallery|GalleryImage */
        if ($this->image) {
            if (file_exists(public_path($this->image))) {
                unlink(public_path($this->image));
            }
            $this->image = null;

            return $this->save();
        }

        return false;
    }
}
