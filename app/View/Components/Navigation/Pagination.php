<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public function __construct(
        public LengthAwarePaginator $paginator,
        public array $fragments = [],
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.navigation.pagination');
    }
}
