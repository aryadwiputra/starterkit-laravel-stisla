<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $type = 'text',
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $value = null,
        public ?string $id = null,
        public bool $required = false,
        public bool $disabled = false,
        public ?string $error = null,
        public ?string $help = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.forms.input');
    }

    public function inputId(): ?string
    {
        return $this->id ?? $this->name;
    }
}
