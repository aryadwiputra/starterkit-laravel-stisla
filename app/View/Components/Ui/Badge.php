<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public function __construct(
        public string $type = 'neutral',
        public bool $soft = false,
        public bool $outline = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.ui.badge');
    }

    public function badgeClass(): string
    {
        $prefix = 'badge';
        if ($this->soft) {
            $prefix = 'badge badge--soft';
        }
        if ($this->outline) {
            $prefix = 'badge badge--outline';
        }

        return "{$prefix} badge--{$this->type}";
    }
}
