<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public array $items = [];

    public function __construct(?array $items = [])
    {
        $this->items = $items;
    }

    public static function make(array $items = []): static
    {
        return new static($items);
    }

    public function render(): View|Closure|string
    {
        return view('components.navigation.breadcrumb');
    }
}
