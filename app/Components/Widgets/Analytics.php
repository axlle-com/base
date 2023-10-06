<?php

namespace App\Components\Widgets;

use Illuminate\View\View;

class Analytics extends Widget
{
    public function view(): ?View
    {
        $debug = config('app.test');
        if (!$debug) {
            return view('widgets.analytics', ['models' => []]);
        }
        return null;
    }
}
