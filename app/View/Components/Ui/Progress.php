<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Progress extends Component
{
    public function __construct(
        public float $value = 0,
        public float $max = 100,
        public bool $striped = false,
        public bool $animated = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.ui.progress');
    }

    public function barClass(): string
    {
        $classes = ['progress-bar'];

        if ($this->striped) {
            $classes[] = 'progress-bar--striped';
        }

        if ($this->animated) {
            $classes[] = 'progress-bar--animated';
        }

        return implode(' ', $classes);
    }

    public function percentage(): float
    {
        return min(100, max(0, ($this->value / $this->max) * 100));
    }
}
