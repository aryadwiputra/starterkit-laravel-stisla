<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Avatar extends Component
{
    public function __construct(
        public ?string $src = null,
        public ?string $name = null,
        public string $size = 'md',
        public bool $circle = false,
        public bool $rounded = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.ui.avatar');
    }

    public function avatarClass(): string
    {
        $size = match ($this->size) {
            'sm' => 'avatar--sm',
            'md' => 'avatar--md',
            'lg' => 'avatar--lg',
            'xl' => 'avatar--xl',
            default => "avatar--{$this->size}",
        };

        $shape = $this->circle ? 'avatar--circle' : ($this->rounded ? 'avatar--rounded' : '');

        return "avatar {$size} {$shape}";
    }

    public function fallback(): string
    {
        if (! $this->name) {
            return '??';
        }

        $words = explode(' ', $this->name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper($word[0] ?? '');
        }

        return $initials ?: '??';
    }
}
