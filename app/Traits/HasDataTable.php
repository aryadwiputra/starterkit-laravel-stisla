<?php

namespace App\Traits;

trait HasDataTable
{
    public static function getDataTableColumns(): array
    {
        $model = new static;
        $columns = [['label' => '#', 'name' => 'id', 'sortable' => true]];

        foreach ($model->getFillable() as $field) {
            if (! in_array($field, ['password', 'remember_token'])) {
                $columns[] = [
                    'label' => ucfirst(str_replace('_', ' ', $field)),
                    'name' => $field,
                    'sortable' => true,
                ];
            }
        }

        return $columns;
    }

    public function dataTableActions(): array
    {
        return [];
    }

    public function renderDataTableAction(string $action, mixed $value): string
    {
        $actions = $this->dataTableActions();

        if (! isset($actions[$action])) {
            return '';
        }

        $config = $actions[$action];
        $url = $config['url'] ?? '#';
        $label = $config['label'] ?? $action;
        $class = $config['class'] ?? 'button button--sm button--ghost button--neutral';
        $icon = $config['icon'] ?? '';
        $confirm = $config['confirm'] ?? false;

        $url = str_replace(['{id}', '{'.$this->getKeyName().'}'], [$this->id, $this->id], $url);

        $attributes = '';

        if ($confirm) {
            $attributes .= ' onclick="return confirm(\'Are you sure?\')"';
        }

        if ($icon) {
            return "<a href=\"{$url}\" class=\"{$class}\"{$attributes}>{$icon} {$label}</a>";
        }

        return "<a href=\"{$url}\" class=\"{$class}\"{$attributes}>{$label}</a>";
    }

    public function renderDataTableRoles(): string
    {
        if (! method_exists($this, 'getRoleNames')) {
            return '-';
        }

        $roles = $this->getRoleNames();

        if ($roles->isEmpty()) {
            return '-';
        }

        return $roles->map(fn ($role) => '<span class="badge badge--soft badge--primary">'.e($role).'</span>')->implode(' ');
    }

    public function getKeyName(): string
    {
        return $this->getKeyName();
    }
}
