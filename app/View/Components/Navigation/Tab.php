<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tab extends Component
{
    public function __construct(
        public string $value,
        public ?string $label = null,
        public bool $active = false,
        public ?string $href = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.navigation.tab');
    }
}
