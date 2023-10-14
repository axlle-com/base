<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('admin', static function ($trail) {
    $trail->push('Главная', route('admin.dashboard'));
});

// Admin > Posts
Breadcrumbs::for('posts', static function ($trail) {
    $trail->parent('admin');
    $trail->push('Список статей', route('admin.post.index'));
});

// Admin > Posts > Post
Breadcrumbs::for('postNew', static function ($trail) {
    $trail->parent('posts');
    $trail->push('Новый пост', '');
});

// Admin > Posts > Post
Breadcrumbs::for('post', static function ($trail, $post) {
    $trail->parent('posts');
    $trail->push('Редактирование поста', '');
});

##### postCategories #####

// Главная >> Список категорий постов
Breadcrumbs::for('postCategories', static function ($trail) {
    $trail->parent('admin');
    $trail->push('Список категорий постов', route('admin.post-category.index'));
});

// Главная >> Список категорий постов >> Новая категория
Breadcrumbs::for('postCategoryNew', static function ($trail) {
    $trail->parent('postCategories');
    $trail->push('Новая категория', '');
});

// Главная >> Список категорий постов >> Редактирование категории
Breadcrumbs::for('postCategory', static function ($trail, $postCategory) {
    $trail->parent('postCategories');
    $trail->push('Редактирование категории', '');
});

##### pages #####

// Главная >> Список категорий постов
Breadcrumbs::for('pages', static function ($trail) {
    $trail->parent('admin');
    $trail->push('Список страниц', route('admin.page.index'));
});

// Главная >> Список категорий постов >> Новая категория
Breadcrumbs::for('pageNew', static function ($trail) {
    $trail->parent('pages');
    $trail->push('Новая страница', '');
});

// Главная >> Список категорий постов >> Редактирование категории
Breadcrumbs::for('page', static function ($trail) {
    $trail->parent('pages');
    $trail->push('Редактирование страницы', '');
});
