<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputGroup extends Component
{
    public function __construct(
        public ?string $label = null,
        public ?string $icon = null,
        public ?string $iconPosition = 'start',
        public bool $large = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.forms.input-group');
    }

    public function inputGroupClass(): string
    {
        $classes = ['input-group'];
        if ($this->large) {
            $classes[] = 'input-group--lg';
        }

        return implode(' ', $classes);
    }
}
