<?php

/** @var $title string
 * @var $model object
 */

?>
<fieldset class="form-block">
    <legend>Сортировка</legend>
    <div class="form-group">
        <input
            type="number"
            class="form-control form-shadow"
            placeholder="Сортировка"
            name="sort"
            value="{{ $model->sort ?? null }}">
        <div class="invalid-feedback"></div>
    </div>
</fieldset>
@if (!empty($menu))
    <fieldset class="form-block">
        <legend>Меню</legend>
        <div class="form-group">
            <select
                class="form-control select2"
                name="menus[]"
                id="menu"
                data-validator="menus"
                multiple
                data-placeholder="Выберете меню">
                @foreach ($menu as $item)
                    <option value="{{ $item['id'] }}" {{ $item['id'] === $model->render_id ? 'selected' : '' }}>
                        {{ $item['title'] }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </fieldset>
@endif
@if (!empty($menu))
    <fieldset class="form-block">
        <legend>Виджеты</legend>
        <div class="form-group">
            <select
                class="form-control select2"
                name="widgets[]"
                id="widgets"
                data-validator="widgets"
                multiple
                data-placeholder="Выберете виджет">
                @foreach ($menu as $item)
                    <option value="{{ $item['id'] }}" {{ $item['id'] === $model->render_id ? 'selected' : '' }}>
                        {{ $item['title'] }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </fieldset>
@endif
