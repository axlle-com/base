<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\StorePageRequest;
use App\Http\Requests\Admin\Page\UpdatePageRequest;
use App\Http\Requests\Admin\Request;
use App\Services\Blog\Page\PageServices;
use App\Services\Render\RenderServices;
use App\Services\UserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    private PageServices $pageServices;
    private RenderServices $renderServices;
    private UserServices $userServices;

    /**
     * @param PageServices $pageServices
     * @param RenderServices $renderServices
     * @param UserServices $userServices
     */
    public function __construct(
        PageServices $pageServices,
        RenderServices $renderServices,
        UserServices $userServices
    ) {
        $this->pageServices = $pageServices;
        $this->renderServices = $renderServices;
        $this->userServices = $userServices;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Список страниц';

        return view('admin.blog.page_index', [
            'title' => $title,
            'models' => $this->pageServices->filter($request->all()),
            'renders' => $this->renderServices->get(),
            'users' => $this->userServices->get(),
            'post' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Новая страница';

        return view('admin.blog.page_update', [
            'title' => $title,
            'model' => null,
            'renders' => $this->renderServices->get(),
            'menu' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(int $id)
    {
        $title = 'Редактирование страницы';

        return view('admin.blog.page_update', [
            'title' => $title,
            'model' => $this->pageServices->find($id),
            'renders' => $this->renderServices->get(),
            'menu' => null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
