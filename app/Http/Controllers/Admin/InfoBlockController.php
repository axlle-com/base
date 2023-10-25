<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\StorePageRequest;
use App\Http\Requests\Admin\Page\UpdatePageRequest;
use App\Http\Requests\Admin\Request;
use App\Models\InfoBlock\InfoBlock;
use App\Services\Blog\InfoBlock\InfoBlockServices;
use App\Services\Render\RenderServices;
use App\Services\UserServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class InfoBlockController extends Controller
{
    private InfoBlockServices $infoBlockServices;
    private RenderServices $renderServices;
    private UserServices $userServices;

    /**
     * @param InfoBlockServices $infoBlockServices
     * @param RenderServices $renderServices
     * @param UserServices $userServices
     */
    public function __construct(
        InfoBlockServices $infoBlockServices,
        RenderServices $renderServices,
        UserServices $userServices
    ) {
        $this->infoBlockServices = $infoBlockServices;
        $this->renderServices = $renderServices;
        $this->userServices = $userServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Список инфо-блоков';

        return view('admin.info_block.index', [
            'title' => $title,
            'models' => $this->infoBlockServices->filter($request->all()),
            'renders' => $this->renderServices->get(InfoBlock::table()),
            'users' => $this->userServices->get(),
            'post' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Новый инфо-блок';

        return view('admin.info_block.update', [
            'title' => $title,
            'renders' => $this->renderServices->get(InfoBlock::table()),
            'model' => null,
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
        $title = 'Редактирование инфо-блока';

        return view('admin.info_block.update', [
            'title' => $title,
            'model' => $this->infoBlockServices->find($id),
            'renders' => $this->renderServices->get(InfoBlock::table()),
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
