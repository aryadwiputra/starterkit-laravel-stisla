@extends('layouts.app')

@section('content')
<header class="page__header">
  <div>
    <h1 class="page__title">Orders</h1>
    <p class="text-muted-foreground mt-1">Manage and track your customer orders.</p>
  </div>
  <a href="{{ route('orders.create') }}" class="button button--primary">
    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
      <path fill="none" stroke="currentColor" stroke-width="1.5" d="M12 5v14m-7-7h14"/>
    </svg>
    New Order
  </a>
</header>

<div class="page__body">
  <div class="card">
    <div class="card__header">
      <div class="flex flex-wrap gap-2">
        <a href="?status=" class="button button--sm button--outline button--primary active">All</a>
        <a href="?status=pending" class="button button--sm button--outline button--neutral">Pending</a>
        <a href="?status=shipping" class="button button--sm button--outline button--neutral">Shipping</a>
        <a href="?status=completed" class="button button--sm button--outline button--neutral">Completed</a>
        <a href="?status=cancelled" class="button button--sm button--outline button--neutral">Cancelled</a>
      </div>
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
          <input type="search" class="input" placeholder="Search orders..."/>
        </div>
        <a href="{{ route('orders.export') }}" class="button button--ghost button--neutral">
          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="none" stroke="currentColor" stroke-width="1.5" d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M8 12l4-4 4 4M12 8v8"/>
          </svg>
        </a>
      </div>
    </div>
    <div class="card__body p-0">
      <div class="table-wrapper">
        <table class="table" id="ordersTable">
          <thead>
            <tr>
              <th class="w-4">
                <input class="checkbox" type="checkbox" data-table-select-all/>
              </th>
              <th><a href="?sort=id">Order ID</a></th>
              <th><a href="?sort=customer">Customer</a></th>
              <th><a href="?sort=status">Status</a></th>
              <th><a href="?sort=amount">Amount</a></th>
              <th><a href="?sort=date">Date</a></th>
              <th class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input class="checkbox" type="checkbox" data-table-select/></td>
              <td><a href="{{ route('orders.show', 10428) }}">#10428</a></td>
              <td>
                <div class="media items-center gap-3">
                  <span class="avatar avatar--sm avatar--circle">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                  </span>
                  <span>Acme Corp</span>
                </div>
              </td>
              <td><span class="badge badge--soft badge--warning">Pending</span></td>
              <td>$1,240.00</td>
              <td>15 Aug 2026</td>
              <td class="text-right">
                <a href="{{ route('orders.show', 10428) }}" class="button button--sm button--ghost button--neutral">View</a>
              </td>
            </tr>
            <tr>
              <td><input class="checkbox" type="checkbox" data-table-select/></td>
              <td><a href="{{ route('orders.show', 10427) }}">#10427</a></td>
              <td>
                <div class="media items-center gap-3">
                  <span class="avatar avatar--sm avatar--circle">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                  </span>
                  <span>Sarah Chen</span>
                </div>
              </td>
              <td><span class="badge badge--soft badge--primary">Shipping</span></td>
              <td>$849.50</td>
              <td>14 Aug 2026</td>
              <td class="text-right">
                <a href="{{ route('orders.show', 10427) }}" class="button button--sm button--ghost button--neutral">View</a>
              </td>
            </tr>
            <tr>
              <td><input class="checkbox" type="checkbox" data-table-select/></td>
              <td><a href="{{ route('orders.show', 10426) }}">#10426</a></td>
              <td>
                <div class="media items-center gap-3">
                  <span class="avatar avatar--sm avatar--circle">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                  </span>
                  <span>Marcus Lee</span>
                </div>
              </td>
              <td><span class="badge badge--soft badge--success">Completed</span></td>
              <td>$2,150.00</td>
              <td>13 Aug 2026</td>
              <td class="text-right">
                <a href="{{ route('orders.show', 10426) }}" class="button button--sm button--ghost button--neutral">View</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card__footer">
      <div class="flex justify-between items-center">
        <span class="text-sm text-muted-foreground">Showing 1 to 3 of 8 entries</span>
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

@push('scripts')
<script src="{{ asset('js/meridian/table-select.js') }}"></script>
@endpush
