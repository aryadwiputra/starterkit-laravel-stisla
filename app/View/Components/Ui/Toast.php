<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toast extends Component
{
    public function __construct(
        public string $type = 'info',
        public ?string $title = null,
        public ?string $message = null,
        public bool $dismissible = true,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.ui.toast');
    }

    public function toastClass(): string
    {
        return match ($this->type) {
            'success' => 'toast toast--success',
            'warning' => 'toast toast--warning',
            'danger', 'error' => 'toast toast--danger',
            default => 'toast toast--info',
        };
    }

    public function icon(): string
    {
        return match ($this->type) {
            'success' => 'circle-check',
            'warning' => 'triangle-alert',
            'danger', 'error' => 'circle-x',
            default => 'circle-info',
        };
    }
}
