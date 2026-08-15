<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StislaTable extends Component
{
    public function __construct(
        public array $columns = [],
        public string $dataRoute = '',
        public string $id = 'data-table',
        public bool $striped = false,
        public bool $hover = false,
        public bool $checkbox = false,
        public bool $actions = false,
        public ?string $caption = null,
        public ?string $emptyMessage = 'No data available',
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.stisla-table');
    }

    public function tableClasses(): string
    {
        $classes = ['table'];

        if ($this->striped) {
            $classes[] = 'table--striped';
        }

        if ($this->hover) {
            $classes[] = 'table--hover';
        }

        return implode(' ', $classes);
    }
}
