<?php

/**
 * @var $url string
 * @var $model \App\Models\BaseModel
 */


$gallery = !empty($gallery) ? 'data-fancybox="gallery"' : 'data-fancybox';

?>


<div class="form-group">
    <label class="control-label button-100" for="js-image-upload">
        <a type="button" class="btn btn-primary button-image">
            Загрузить фото
        </a>
    </label>
    <input
        type="file"
        id="js-image-upload"
        class="custom-input-file js-image-upload"
        name="image"
        accept="image/*">
    <div class="invalid-feedback"></div>
</div>
