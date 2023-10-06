<?php

namespace App\Components\Widgets;

use Illuminate\View\View;

abstract class Widget
{
    public static function widget(array $config = []): ?View
    {
        return (new static($config))->view();
    }

    abstract public function view(): ?View;
}
