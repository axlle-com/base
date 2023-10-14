<?php

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Models\Page\Page;

/**
 * @var string $url
 * @var Post|PostCategory|Page $model
 */

?>
<div class="img block-image js-image-block">
    @if ($model && $url = $model->image ?? null)
        @php
            $fancybox = '';
            $href = '';
            if (empty($gallery)) {
                $fancybox = 'data-fancybox';
                $href = route('admin.image.ajax.delete', ['id' => $model->id]);
            } else {
                $fancybox = 'data-fancybox="gallery"';
                $href = route('admin.ajax.gallery-image.destroy', ['gallery_image' => $model->id]);
            }
        @endphp
        <div class="image-box"
             style="background-image: url({{ $url }}); background-size: cover;background-position: center;">
        </div>
        <div class="overlay-content text-center justify-content-end">
            <div class="btn-group mb-1" role="group">
                <a {{ $fancybox }} href="{{ $url }}">
                    <button type="button" class="btn btn-link btn-icon text-danger">
                        <i class="material-icons">zoom_in</i>
                    </button>
                </a>
                <button
                    type="button"
                    class="btn btn-link btn-icon text-danger"
                    data-js-image-href="{{ $href }}"
                    data-js-image-model="{{ $model->getTable() }}"
                    data-js-image-id="{{ $model->id }}"
                    data-js-image-array-id="">
                    <i class="material-icons">delete</i>
                </button>
            </div>
        </div>
    @endif
</div>
