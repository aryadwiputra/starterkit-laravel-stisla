<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tabs extends Component
{
    public function __construct(
        public bool $pills = false,
        public bool $box = false,
        public bool $fill = false,
        public bool $justified = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.navigation.tabs');
    }

    public function tabsClass(): string
    {
        $classes = ['tabs'];

        if ($this->pills) {
            $classes[] = 'tabs--pills';
        }

        if ($this->box) {
            $classes[] = 'tabs--box';
        }

        if ($this->fill) {
            $classes[] = 'tabs--fill';
        }

        if ($this->justified) {
            $classes[] = 'tabs--justified';
        }

        return implode(' ', $classes);
    }
}
