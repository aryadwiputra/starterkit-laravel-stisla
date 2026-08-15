@extends('layouts.app')

@section('content')
<header class="page__header">
  <div>
    <h1 class="page__title">Products</h1>
    <p class="text-muted-foreground mt-1">Manage your product inventory.</p>
  </div>
  <a href="{{ route('products.create') }}" class="button button--primary">
    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
      <path fill="none" stroke="currentColor" stroke-width="1.5" d="M12 5v14m-7-7h14"/>
    </svg>
    Add Product
  </a>
</header>

<div class="page__body">
  <div class="card">
    <div class="card__header">
      <div class="flex gap-2">
        <div class="input-group">
          <span class="input-group__text">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
              <g fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="11.5" cy="11.5" r="9.5"/>
                <path stroke-linecap="round" d="M18.5 18.5L22 22"/>
              </g>
            </svg>
          </span>
          <input type="search" class="input" placeholder="Search products..."/>
        </div>
        <select class="input w-auto">
          <option>All Categories</option>
          <option>Electronics</option>
          <option>Furniture</option>
          <option>Clothing</option>
        </select>
      </div>
      <a href="{{ route('products.export') }}" class="button button--ghost button--neutral">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
          <path fill="none" stroke="currentColor" stroke-width="1.5" d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M8 12l4-4 4 4M12 8v8"/>
        </svg>
        Export
      </a>
    </div>
    <div class="card__body p-0">
      <div class="table-wrapper">
        <table class="table">
          <thead>
            <tr>
              <th class="w-4">
                <input class="checkbox" type="checkbox" data-table-select-all/>
              </th>
              <th>Product</th>
              <th>Category</th>
              <th>Stock</th>
              <th>Price</th>
              <th>Status</th>
              <th class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input class="checkbox" type="checkbox" data-table-select/></td>
              <td>
                <div class="media items-center gap-3">
                  <span class="avatar avatar--md avatar--rounded">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                  </span>
                  <span class="font-medium">Headphone Blitz</span>
                </div>
              </td>
              <td>Electronics</td>
              <td>48</td>
              <td>$199.00</td>
              <td><span class="badge badge--soft badge--success">Active</span></td>
              <td class="text-right">
                <a href="{{ route('products.edit', 1) }}" class="button button--sm button--ghost button--neutral">Edit</a>
              </td>
            </tr>
            <tr>
              <td><input class="checkbox" type="checkbox" data-table-select/></td>
              <td>
                <div class="media items-center gap-3">
                  <span class="avatar avatar--md avatar--rounded">
                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                  </span>
                  <span class="font-medium">Smart Watch X</span>
                </div>
              </td>
              <td>Electronics</td>
              <td>36</td>
              <td>$299.00</td>
              <td><span class="badge badge--soft badge--success">Active</span></td>
              <td class="text-right">
                <a href="{{ route('products.edit', 2) }}" class="button button--sm button--ghost button--neutral">Edit</a>
              </td>
            </tr>
            <tr>
              <td><input class="checkbox" type="checkbox" data-table-select/></td>
              <td>
                <div class="media items-center gap-3">
                  <span class="avatar avatar--md avatar--rounded">
                    <img src="https://images.unsplash.com/photo-1491553895911-0055uj63d07a?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                  </span>
                  <span class="font-medium">Minimal Desk</span>
                </div>
              </td>
              <td>Furniture</td>
              <td class="text-danger">4</td>
              <td>$543.00</td>
              <td><span class="badge badge--soft badge--warning">Low Stock</span></td>
              <td class="text-right">
                <a href="{{ route('products.edit', 3) }}" class="button button--sm button--ghost button--neutral">Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card__footer">
      <div class="flex justify-between items-center">
        <span class="text-sm text-muted-foreground">Showing 1 to 3 of 12 entries</span>
        <nav class="pagination">
          <a class="pagination__item pagination__item--prev" href="#">Prev</a>
          <a class="pagination__item active" href="#">1</a>
          <a class="pagination__item" href="#">2</a>
          <a class="pagination__item" href="#">3</a>
          <a class="pagination__item pagination__item--next" href="#">Next</a>
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection
