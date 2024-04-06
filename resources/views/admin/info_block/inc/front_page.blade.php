<?php

use App\Models\Post\Post;
use App\Models\Page\Page;
use App\Models\Post\PostCategory;
use Illuminate\Database\Eloquent\Collection;

/**
 * @var $title string
 * @var $model PostCategory|Post|Page
 * @var $postCategories PostCategory[]|Collection
 */

?>
<div class="col-md-8">
    @if(!empty($renders))
        <fieldset class="form-block">
            <legend>Связь данных</legend>
            <div class="form-group small">
                <label for="blogTitle">Шаблон</label>
                <select
                    class="form-control select2"
                    data-placeholder="Шаблон"
                    data-select2-search="true"
                    name="render"
                    data-validator="render">
                    <option></option>
                    @foreach ($renders as $key => $item)
                        <option
                            value="{{ $key }}" {{ ($key === $model->render) ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback"></div>
            </div>
        </fieldset>
    @endif
    <fieldset class="form-block">
        <legend>Заголовок</legend>
        <div class="form-group small">
            <label for="blogTitle">Обычный</label>
            <input
                class="form-control form-shadow"
                placeholder="Обычный"
                name="title"
                id="title"
                value="<?= $model->title ?? null ?>"
                data-validator-required
                data-validator="title">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group small">
            <label for="blogTitle">Короткий</label>
            <input
                class="form-control form-shadow"
                placeholder="Короткий"
                name="title_short"
                id="title_short"
                value="<?= $model->title_short ?? null ?>"
                data-validator="title_short">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group small">
            <label for="blogTitle">Короткое описание</label>
            <textarea
                class="form-control form-shadow"
                placeholder="Короткое описание"
                name="preview_description"
                id="preview_description"
                data-validator="preview_description"><?= $model->preview_description ?? null ?></textarea>
            <div class="invalid-feedback"></div>
        </div>
    </fieldset>
    <div class="form-group small">
        <textarea
            name="description"
            id="description"
            class="form-control summernote-500"><?= $model->description ?? null ?></textarea>
    </div>
</div>
