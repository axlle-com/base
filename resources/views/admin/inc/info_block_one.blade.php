<?php

use App\Models\InfoBlock\InfoBlockHasResource;
use App\Models\InfoBlock\InfoBlock;

/**
 * @var $infoBlock InfoBlock
 */

$id = $infoBlock->pivot->id ?? \Illuminate\Support\Str::uuid()->toString();

?>
<input
    type="hidden"
    name="info_block[{{ $id }}][id]"
    value="{{ $infoBlock->id }}">
<div class="md-block-5 js-info-block-item sort-handle">
    <div>
        <div class="info-block-item-info">
            <h6 title="{{ $infoBlock->title }}">
                <a href="{{ route('admin.info-block.edit', ['info_block' => $infoBlock->id ]) }}">
                    {{ $infoBlock->title_short ?? $infoBlock->title }}
                </a>
            </h6>
            <p title="{{ strip_tags($infoBlock->description) }}">{!! strip_tags($infoBlock->preview_description ?? $infoBlock->description) !!}</p>
        </div>
        <div class="form-group small">
            <select
                class="form-control select2"
                name="info_block[{{ $id }}][position]"
                id="position"
                data-validator="position"
                data-placeholder="Позиция">
                @foreach (InfoBlockHasResource::getPositions() as $key => $value)
                    <option value="{{ $key }}" {{ $infoBlock->pivot && $key === $infoBlock->pivot->position ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group small">
            <input
                class="form-control form-shadow"
                placeholder="Сортировка"
                type="number"
                name="info_block[{{ $id }}][sort]"
                value="{{ $infoBlock->pivot->sort ?? 0 }}">
            <div class="invalid-feedback"></div>
        </div>
    </div>
</div>
