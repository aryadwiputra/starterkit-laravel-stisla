<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public function __construct(
        public ?string $name = null,
        public ?string $label = null,
        public bool $checked = false,
        public ?string $value = '1',
        public bool $disabled = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.forms.checkbox');
    }
}
