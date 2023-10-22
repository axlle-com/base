<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('admin', static function ($trail) {
    $trail->push('Главная', route('admin.dashboard'));
});

Breadcrumbs::for('posts', static function ($trail) {
    $trail->parent('admin');
    $trail->push('Список статей', route('admin.post.index'));
});

Breadcrumbs::for('postNew', static function ($trail) {
    $trail->parent('posts');
    $trail->push('Новый пост', '');
});

Breadcrumbs::for('post', static function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('Редактирование поста', '');
});

##### postCategories #####

Breadcrumbs::for('postCategories', static function ($trail) {
    $trail->parent('admin');
    $trail->push('Список категорий постов', route('admin.post-category.index'));
});

Breadcrumbs::for('postCategoryNew', static function ($trail) {
    $trail->parent('postCategories');
    $trail->push('Новая категория', '');
});

Breadcrumbs::for('postCategory', static function ($trail, $postCategory) {
    $trail->parent('postCategories');
    $trail->push('Редактирование категории', '');
});

##### pages #####

Breadcrumbs::for('pages', static function ($trail) {
    $trail->parent('admin');
    $trail->push('Список страниц', route('admin.page.index'));
});

Breadcrumbs::for('pageNew', static function ($trail) {
    $trail->parent('pages');
    $trail->push('Новая страница', '');
});

Breadcrumbs::for('page', static function ($trail) {
    $trail->parent('pages');
    $trail->push('Редактирование страницы', '');
});

##### info-block #####

Breadcrumbs::for('infoBlocks', static function ($trail) {
    $trail->parent('admin');
    $trail->push('Список инфо-блоков', route('admin.info-block.index'));
});

Breadcrumbs::for('infoBlockNew', static function ($trail) {
    $trail->parent('infoBlocks');
    $trail->push('Новый инфо-блок', '');
});

Breadcrumbs::for('infoBlock', static function ($trail) {
    $trail->parent('infoBlocks');
    $trail->push('Редактирование инфо-блока', '');
});
