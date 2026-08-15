<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $value = null,
        public ?string $id = null,
        public int $rows = 4,
        public bool $required = false,
        public bool $disabled = false,
        public ?string $error = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.forms.textarea');
    }

    public function inputId(): ?string
    {
        return $this->id ?? $this->name;
    }
}
