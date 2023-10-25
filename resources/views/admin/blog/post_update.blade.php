<?php

use App\Models\Post\Post;

/**
 * @var $title string
 * @var $breadcrumb string
 * @var $model Post
 */

$title = $title ?? 'Заголовок';
if ($model && $model->id) {
    $action = route('admin.ajax.post.update', ['post' => $model->id, '_method' => 'PUT']);
    $breadcrumbsName = 'post';
} else {
    $action = route('admin.ajax.post.store');
    $breadcrumbsName = 'postNew';
}

?>

@extends('admin.layouts.main',['title' => $model->meta_title ?? null])

@section('content')
    <div class="main-body">
        {{ Breadcrumbs::render($breadcrumbsName, $model ?? null) }}
        <h5>{{ $title }}</h5>
        <div>
            <form id="global-form" action="{{ $action }}">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="list-with-gap mb-2">
                                    <button type="button" class="btn btn-success js-save-button">Сохранить</button>
                                    <a type="button" class="btn btn-secondary" href="{{ route('admin.post.index') }}">Выйти</a>
                                </div>
                                <div class="list-with-gap mb-2">
                                    <ul class="nav nav-gap-x-1 mt-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-faded active"
                                               id="home-tab-faded"
                                               data-toggle="tab"
                                               href="#home-page"
                                               role="tab"
                                               aria-controls="home-page"
                                               aria-selected="false">Основное</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-faded"
                                               id="profile-tab-faded"
                                               data-toggle="tab"
                                               href="#tab2Faded"
                                               role="tab"
                                               aria-controls="tab2Faded"
                                               aria-selected="false">Галерея</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-faded"
                                               id="info-block-tab-faded"
                                               data-toggle="tab"
                                               href="#tab3Faded"
                                               role="tab"
                                               aria-controls="tab3Faded"
                                               aria-selected="true">Инфо-блоки</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-faded"
                                               id="settings-tab-faded"
                                               data-toggle="tab"
                                               href="#tab4Faded"
                                               role="tab"
                                               aria-controls="tab4Faded"
                                               aria-selected="true">Настройки</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade active show"
                                         id="home-page"
                                         role="tabpanel"
                                         aria-labelledby="home-tab-faded">
                                        <div class="row">
                                            @include('admin.blog.inc.front_page')
                                            <div class="col-md-4">
                                                <fieldset class="form-block">
                                                    <legend>Изображение</legend>
                                                    @include('admin.inc.image')
                                                    @include('admin.inc.image_empty')
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input
                                                                type="checkbox"
                                                                class="custom-control-input"
                                                                name="is_image_post"
                                                                id="is_image_post"
                                                                value="1"
                                                                {{ $model && $model->is_image_post ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="is_image_post">
                                                                Отобразить изображение
                                                            </label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input
                                                                type="checkbox"
                                                                class="custom-control-input"
                                                                name="is_image_category"
                                                                id="is_image_category"
                                                                value="1"
                                                                {{ $model && $model->is_image_category ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="is_image_category">
                                                                Отобразить изображение в категории
                                                            </label>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="form-block">
                                                    <div class="custom-control custom-checkbox">
                                                        <input
                                                            type="checkbox"
                                                            class="custom-control-input"
                                                            name="is_comments"
                                                            id="is_comments"
                                                            value="1"
                                                            {{ $model && $model->is_comments ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="is_comments">
                                                            Подключить комментарии
                                                        </label>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="form-block">
                                                    <legend>Публикация</legend>
                                                    <div class="input-group datepicker-wrap form-group">
                                                        <label for="blogTitle">Дата публикации</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="date_pub"
                                                            value="{{ $model ? $model->date_pub?->format('d.m.Y H:i:s') : '' }}"
                                                            placeholder="Укажите дату"
                                                            autocomplete="off"
                                                            data-input>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-light btn-icon"
                                                                    type="button"
                                                                    title="Choose date"
                                                                    data-toggle>
                                                                <i class="material-icons">calendar_today</i>
                                                            </button>
                                                            <button class="btn btn-light btn-icon"
                                                                    type="button"
                                                                    title="Clear"
                                                                    data-clear>
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input
                                                                type="checkbox"
                                                                class="custom-control-input"
                                                                name="is_published"
                                                                id="is_published"
                                                                value="1"
                                                                <?= $model && $model->is_published ? 'checked' : '' ?>>
                                                            <label class="custom-control-label" for="is_published">Опубликовано</label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input
                                                                type="checkbox"
                                                                class="custom-control-input"
                                                                name="show_date"
                                                                id="show_date"
                                                                value="1"
                                                                <?= $model && $model->show_date ? 'checked' : '' ?>>
                                                            <label class="custom-control-label" for="show_date">Показывать
                                                                дату в посте</label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                    <div class="input-group datepicker-wrap form-group">
                                                        <label for="blogTitle">Дата окончания публикации</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="date_end"
                                                            value="{{ $model ? $model->date_end?->format('d.m.Y H:i:s') : '' }}"
                                                            placeholder="Укажите дату"
                                                            autocomplete="off"
                                                            data-input>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-light btn-icon" type="button"
                                                                    title="Choose date" data-toggle><i
                                                                    class="material-icons">calendar_today</i>
                                                            </button>
                                                            <button class="btn btn-light btn-icon" type="button"
                                                                    title="Clear" data-clear><i class="material-icons">close</i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input
                                                                type="checkbox"
                                                                class="custom-control-input"
                                                                name="control_date_pub"
                                                                id="control_date_pub"
                                                                value="1"
                                                                {{ $model && $model->control_date_pub ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="control_date_pub">
                                                                Контролировать дату публикации
                                                            </label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input
                                                                type="checkbox"
                                                                class="custom-control-input"
                                                                name="control_date_end"
                                                                id="control_date_end"
                                                                value="1"
                                                                {{ $model && $model->control_date_end ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="control_date_end">
                                                                Контролировать дату окончания
                                                            </label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input
                                                                type="checkbox"
                                                                class="custom-control-input"
                                                                name="is_favourites"
                                                                id="is_favourites"
                                                                value="1"
                                                                {{ $model && $model->is_favourites ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="is_favourites">Избранное</label>
                                                            <div class="invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                @include('admin.inc.side_bar_widgets')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2Faded" role="tabpanel"
                                         aria-labelledby="profile-tab-faded">
                                        @include('admin.inc.gallery')
                                    </div>
                                    <div class="tab-pane fade" id="tab3Faded" role="tabpanel"
                                         aria-labelledby="info-block-tab-faded">
                                        @include('admin.inc.info_block')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
