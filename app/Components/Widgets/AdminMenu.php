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
        ],
    ];

    /**
     * @return void
     */
    private function page(): void
    {
        $url = $_SERVER['REQUEST_URI'];
        if ($url === '/admin') {
            $this->activePage['admin'] = 'active';
        }
        if (strripos($url, '/admin/blog/category') !== false) {
            $this->activePage['blog_category'] = 'active';
        }
        if (strripos($url, '/admin/blog/post') !== false) {
            $this->activePage['blog_post'] = 'active';
        }
        if (strripos($url, '/admin/catalog/category') !== false) {
            $this->activePage['catalog_category'] = 'active';
        }
        if (strripos($url, 'admin/catalog/product') !== false) {
            $this->activePage['catalog_product'] = 'active';
        }
        if (strripos($url, 'admin/catalog/property') !== false) {
            $this->activePage['catalog_property'] = 'active';
        }
        if (strripos($url, '/admin/catalog/coupon') !== false) {
            $this->activePage['coupon'] = 'active';
        }
        if (strripos($url, '/admin/catalog/document') !== false) {
            $this->activePage['document'] = 'active';
        }
        if (strripos($url, '/admin/catalog/document/order') !== false) {
            $this->activePage['order'] = 'active';
        }
        if (strripos($url, '/admin/catalog/document/fin-invoice') !== false) {
            $this->activePage['fin_invoice'] = 'active';
        }
        if (strripos($url, '/admin/catalog/document/coming') !== false) {
            $this->activePage['coming'] = 'active';
        }
        if (strripos($url, '/admin/catalog/document/write-off') !== false) {
            $this->activePage['write-off'] = 'active';
        }
        if (strripos($url, '/admin/catalog/document/reservation') !== false) {
            $this->activePage['reservation'] = 'active';
        }
        if (strripos($url, '/admin/catalog/document/reservation-cancel') !== false) {
            $this->activePage['reservation-cancel'] = 'active';
        }
        if (strripos($url, '/admin/page') !== false) {
            $this->activePage['page'] = 'active';
        }
        if (strripos($url, '/admin/catalog/storage') !== false) {
            $this->activePage['catalog_storage'] = 'active';
        }
        if (strripos($url, '/admin/storage-place') !== false) {
            $this->activePage['storage_place'] = 'active';
        }
        if (strripos($url, '/admin/report') !== false) {
            $this->activePage['report'] = 'active show';
        }
        if (strripos($url, '/admin/report/storage-balance-simple') !== false) {
            $this->activePage['storage_balance_simple'] = 'active';
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
