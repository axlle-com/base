<?php

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Models\Page\Page;

/**
 * @var $title string
 * @var $model PostCategory|Post|Page
 */

$galleries = $model->manyGalleryWithImages ?? [];

?>
<div class="catalog-tabs">
    @if(count($galleries))
        @foreach ($galleries as $gallery)
            <div class="js-galleries-general-block">
                <input
                    type="hidden"
                    name="galleries[{{ $gallery->id }}][gallery_id]"
                    value="{{ $gallery->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label button-100" for="js-gallery-input-{{ $gallery->id }}">
                            <a
                                type="button"
                                class="btn btn-primary catalog-tabs-add">
                                Загрузить фото</a>
                        </label>
                        <input
                            type="file"
                            id="js-gallery-input-{{ $gallery->id }}"
                            data-js-gallery-id="{{ $gallery->id }}"
                            class="custom-input-file js-gallery-input js-gallery-input"
                            name=""
                            multiple
                            accept="image/*">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="parts-gallery js-gallery-block-saved sortable swap">
                            @foreach ($gallery->images as $image)
                                <div class="md-block-5 js-gallery-item sort-handle">
                                    <div class="img rounded">
                                        <input
                                            type="hidden"
                                            name="galleries[{{ $gallery->id }}][images][{{ $image->id }}][id]"
                                            value="{{ $image->id }}">
                                        @include('admin.inc.image', ['url' => $image->image, 'model' => $image, 'gallery' => true])
                                    </div>
                                    <div>
                                        <div class="form-group small">
                                            <input
                                                class="form-control form-shadow"
                                                placeholder="Заголовок"
                                                name="galleries[{{ $gallery->id }}][images][{{ $image->id }}][title]"
                                                value="{{ $image->title }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group small">
                                            <input
                                                class="form-control form-shadow"
                                                placeholder="Описание"
                                                name="galleries[{{ $gallery->id }}][images][{{ $image->id }}][description]"
                                                value="{{ $image->description }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group small">
                                            <input
                                                class="form-control form-shadow"
                                                placeholder="Сортировка"
                                                type="number"
                                                name="galleries[{{ $gallery->id }}][images][{{ $image->id }}][sort]"
                                                value="{{ $image->sort }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="js-galleries-general-block">
            <div class="row">
                <div class="col-md-12">
                    <label class="control-label button-100" for="js-gallery-input-0">
                        <a
                            type="button"
                            class="btn btn-primary catalog-tabs-add">
                            Загрузить фото</a>
                    </label>
                    <input
                        type="file"
                        id="js-gallery-input-0"
                        data-js-gallery-id=""
                        class="custom-input-file js-gallery-input"
                        name=""
                        multiple
                        accept="image/*">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="parts-gallery js-gallery-block-saved sortable swap"></div>
                </div>
            </div>
        </div>
    @endif
</div>
