<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DataTableService
{
    protected Builder $query;

    protected array $columns = [];

    protected array $relations = [];

    protected array $columnOverrides = [];

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function withRelations(array $relations): self
    {
        $this->relations = $relations;
        $this->query->with($relations);

        return $this;
    }

    public function setColumns(array $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    public function columnOverride(string $name, callable $callback): self
    {
        $this->columnOverrides[$name] = $callback;

        return $this;
    }

    public function make(): JsonResponse
    {
        $query = $this->query;

        return DataTables::of($query)
            ->addColumn('checkbox', function ($model) {
                return '<input type="checkbox" class="checkbox" data-check-row value="'.$model->id.'">';
            })
            ->editColumn('id', fn ($model) => $model->id)
            ->addColumn('roles', fn ($model) => $this->renderRoles($model))
            ->addColumn('actions', fn ($model) => $this->renderActions($model))
            ->rawColumns(['checkbox', 'roles', 'actions'])
            ->make(true);
    }

    protected function renderRoles($model): string
    {
        if (! method_exists($model, 'getRoleNames')) {
            return '-';
        }

        $roles = $model->getRoleNames();

        if ($roles->isEmpty()) {
            return '-';
        }

        return $roles->map(fn ($role) => '<span class="badge badge--soft badge--primary">'.e($role).'</span>')->implode(' ');
    }

    protected function renderActions($model): string
    {
        if (! method_exists($model, 'dataTableActions')) {
            return '';
        }

        $actions = $model->dataTableActions();
        $auth = Auth::user();

        $html = '';

        foreach ($actions as $action => $config) {
            if (isset($config['permission']) && $auth && ! $auth->can($config['permission'])) {
                continue;
            }

            $url = str_replace(
                ['{id}', '{'.$model->getKeyName().'}'],
                [$model->id, $model->id],
                $config['url'] ?? '#'
            );

            $label = $config['label'] ?? ucfirst($action);
            $class = $config['class'] ?? 'button button--sm button--ghost button--neutral';
            $confirm = $config['confirm'] ?? false;

            $attributes = '';
            if ($confirm) {
                $attributes .= ' onclick="return confirm(\'Are you sure?\')"';
            }
            if (isset($config['target'])) {
                $attributes .= ' target="'.$config['target'].'"';
            }

            $html .= "<a href=\"{$url}\" class=\"{$class}\"{$attributes}>{$label}</a> ";
        }

        return $html;
    }
}
