<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyState extends Component
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?string $icon = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.ui.empty-state');
    }

    public function defaultIcon(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M3 3l18 18M10 12.5a5.5 5.5 0 0111 0m-16 0a5.5 5.5 0 0111 0m-16 0l16 0M6.5 6.5l11 11"/>
        </svg>';
    }
}
