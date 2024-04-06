<?php

/**
 * @var $title string
 * @var $breadcrumb string
 * @var $model \App\Models\InfoBlock\InfoBlock|null
 */

$title = $title ?? 'Заголовок';
if ($model && $model->id) {
    $action = route('admin.ajax.info-block.update', ['info_block' => $model->id, '_method' => 'PUT']);
    $breadcrumbsName = 'infoBlock';
} else {
    $action = route('admin.ajax.info-block.store');
    $breadcrumbsName = 'infoBlockNew';
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
                                    <a type="button" class="btn btn-secondary" href="{{ route('admin.info-block.index') }}">Выйти</a>
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
                                               id="contact-tab-faded"
                                               data-toggle="tab"
                                               href="#tab3Faded"
                                               role="tab"
                                               aria-controls="tab3Faded"
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
                                            @include('admin.info_block.inc.front_page')
                                            <div class="col-md-4">
                                                <fieldset class="form-block">
                                                    <legend>Изображение</legend>
                                                    @include('admin.inc.image')
                                                    @include('admin.inc.image_empty')
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2Faded" role="tabpanel"
                                         aria-labelledby="profile-tab-faded">
                                        @include('admin.inc.gallery')
                                    </div>
                                    <div class="tab-pane fade" id="tab3Faded" role="tabpanel"
                                         aria-labelledby="contact-tab-faded">
                                        Settings
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
