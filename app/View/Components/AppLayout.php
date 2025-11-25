<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public string $tabName = '';
    public array $pages = [];

    /**
     * Create a new component instance.
     */
    public function __construct(String $tabName = '') {
        $this->tabName = empty($tabName) ? config('app.name') : $tabName . ' | ' . config('app.name');
        $this->pages = Auth::user()->menu;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.app-layout');
    }
}
