<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ThemeComposer
{
    public function compose(View $view): void
    {
        if (Auth::check()) {
            $theme = Auth::user()->theme;
        } else {
            $theme = request()->cookie('theme', 'light');
        }

        $view->with('resolvedTheme', $theme);
    }
}
