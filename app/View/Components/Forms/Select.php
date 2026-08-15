<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public array $options = [];

    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public ?string $placeholder = 'Select an option',
        public ?string $id = null,
        public array $items = [],
        public mixed $value = null,
        public bool $required = false,
        public bool $disabled = false,
        public ?string $error = null,
    ) {
        $this->options = $items;
    }

    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }

    public function inputId(): ?string
    {
        return $this->id ?? $this->name;
    }

    public function isSelected(string|int $optionValue): bool
    {
        return (string) $this->value === (string) $optionValue;
    }
}
