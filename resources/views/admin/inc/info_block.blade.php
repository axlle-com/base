<?php

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Models\Page\Page;
use App\Models\InfoBlock\InfoBlock;

/**
 * @var $title string
 * @var $model PostCategory|Post|Page
 * @var $infoBlocks InfoBlock[]
 */

$modelInfoBlocks = $model->infoBlocks ?? [];

?>
<div class="catalog-tabs">
    <div class="row">
        <div class="col-sm-6">
            <fieldset class="form-block js-info-block-select-form">
                <legend>Выбор инфо-блока</legend>
                <div class="form-group small mb-3">
                    <select
                        class="form-control select2"
                        id="info_blocks"
                        data-placeholder="Выбор инфо-блока">
                        @foreach ($infoBlocks as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->title_short ?? $item->title}}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="list-with-gap mb-2">
                    <button
                        type="button"
                        class="btn btn-primary js-info-block-add">Добавить
                    </button>
                    <a type="button" target="_blank" class="btn btn-primary" href="{{ route('admin.info-block.create') }}">Создать</a>
                </div>
            </fieldset>
        </div>
    </div>
    @if(count($modelInfoBlocks))
        <div class="row">
            <div class="col-sm-12">
                <div class="parts-info-block js-info-block-general-block sortable swap">
                    @foreach ($modelInfoBlocks as $infoBlock)
                        @include('admin.inc.info_block_one', ['infoBlock' => $infoBlock])
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-12">
                <div class="parts-info-block js-info-block-general-block sortable swap">
                </div>
            </div>
        </div>
    @endif
</div>
