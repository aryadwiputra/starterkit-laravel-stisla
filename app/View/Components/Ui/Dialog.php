<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dialog extends Component
{
    public function __construct(
        public string $id = 'dialog',
        public ?string $title = null,
        public string $size = 'md',
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.ui.dialog');
    }

    public function dialogClass(): string
    {
        return match ($this->size) {
            'sm' => 'dialog__panel--sm',
            'lg' => 'dialog__panel--lg',
            default => 'dialog__panel',
        };
    }
}
