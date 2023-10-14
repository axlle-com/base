<?php

namespace App\Components\Widgets;

use Illuminate\View\View;

class AdminMenu extends Widget
{
    private array $activePage = [];
    private array $menu = [
        'ГЛАВНАЯ' => [
            [
                'admin',
                '<i data-feather="globe"></i>',
                '/admin',
                'Аналитика',
            ],
        ],
        'БЛОГ' => [
            [
                'blog_category',
                '<i class="material-icons">list_alt</i>',
                '/admin/blog/post-category',
                'Категории',
            ],
            [
                'blog_post',
                '<i class="material-icons">list_alt</i>',
                '/admin/blog/post',
                'Посты',
            ],
            [
                'blog_comment',
                '<i class="material-icons">list_alt</i>',
                '/admin/blog/comment',
                'Комментарии',
            ],
            [
                'blog_page',
                '<i class="material-icons">list_alt</i>',
                '/admin/blog/page',
                'Страницы',
            ],
        ],
    ];

    /**
     * @return void
     */
    private function page(): void
    {
        $parseUrl = parse_url($_SERVER['REQUEST_URI']);
        $array = explode('/', trim($parseUrl['path'], '/'));
        if (($array[2] ?? null) === 'post-category') {
            $this->activePage['blog_category'] = 'active';
        }
        if (($array[2] ?? null) === 'post') {
            $this->activePage['blog_post'] = 'active';
        }
        if (($array[2] ?? null) === 'page') {
            $this->activePage['page'] = 'active';
        }
    }

    /**
     * @return View|null
     */
    public function view(): ?View
    {
        $this->page();
        return view('admin.widgets.menu', [
            'menu' => $this->menu,
            'page' => $this->activePage,
        ]);
    }
}
