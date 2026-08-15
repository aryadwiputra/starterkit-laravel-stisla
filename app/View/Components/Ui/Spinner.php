<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Spinner extends Component
{
    public function __construct(
        public string $size = 'md',
        public string $label = 'Loading',
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.ui.spinner');
    }

    public function spinnerClass(): string
    {
        return match ($this->size) {
            'sm' => 'spinner--sm',
            'lg' => 'spinner--lg',
            default => "spinner--{$this->size}",
        };
    }
}
