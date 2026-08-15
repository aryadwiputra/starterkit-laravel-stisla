<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public string $type = 'neutral',
        public ?string $size = null,
        public ?string $href = null,
        public bool $block = false,
        public bool $iconOnly = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.ui.button');
    }

    public function classes(): string
    {
        $classes = ['button', "button--{$this->type}"];

        if ($this->size) {
            $classes[] = "button--{$this->size}";
        }

        if ($this->block) {
            $classes[] = 'button--block';
        }

        if ($this->iconOnly) {
            $classes[] = 'button--icon-only';
        }

        return implode(' ', $classes);
    }
}
