<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public function __construct(
        public string $type = 'info',
        public ?string $title = null,
        public ?string $message = null,
        public bool $dismissible = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.ui.alert');
    }

    public function alertClass(): string
    {
        return match ($this->type) {
            'success' => 'alert alert--success',
            'warning' => 'alert alert--warning',
            'danger' => 'alert alert--danger',
            'info' => 'alert alert--info',
            default => 'alert',
        };
    }
}
