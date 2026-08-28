<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Link extends Component
{
    public string $href;
    public bool $active;
    public bool $navigate;

    public function __construct(string $href, $routeActive = null, $navigate = true)
    {
        $this->navigate = $navigate;
        $this->href = $href;
        $this->active = request()->is($routeActive ? $routeActive : Str::substr($href, 1));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.link');
    }
}
