@extends('layouts.app')

@section('content')
<header class="page__header">
  <div>
    <h1 class="page__title">Customers</h1>
    <p class="text-muted-foreground mt-1">View and manage your customer base.</p>
  </div>
  <button class="button button--primary">
    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
      <path fill="none" stroke="currentColor" stroke-width="1.5" d="M12 5v14m-7-7h14"/>
    </svg>
    Add Customer
  </button>
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
          <input type="search" class="input" placeholder="Search customers..."/>
        </div>
      </div>
    </div>
    <div class="card__body p-0">
      <div class="table-wrapper">
        <table class="table">
          <thead>
            <tr>
              <th>Customer</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Orders</th>
              <th>Total Spent</th>
              <th class="text-right">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="media items-center gap-3">
                  <span class="avatar avatar--sm avatar--circle">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                  </span>
                  <span class="font-medium">Acme Corp</span>
                </div>
              </td>
              <td>contact@acmecorp.com</td>
              <td>+1 (555) 123-4567</td>
              <td>12</td>
              <td>$8,459.00</td>
              <td class="text-right">
                <a href="#" class="button button--sm button--ghost button--neutral">View</a>
              </td>
            </tr>
            <tr>
              <td>
                <div class="media items-center gap-3">
                  <span class="avatar avatar--sm avatar--circle">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                  </span>
                  <span class="font-medium">Sarah Chen</span>
                </div>
              </td>
              <td>sarah.chen@example.com</td>
              <td>+1 (555) 234-5678</td>
              <td>8</td>
              <td>$5,234.00</td>
              <td class="text-right">
                <a href="#" class="button button--sm button--ghost button--neutral">View</a>
              </td>
            </tr>
            <tr>
              <td>
                <div class="media items-center gap-3">
                  <span class="avatar avatar--sm avatar--circle">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                  </span>
                  <span class="font-medium">Marcus Lee</span>
                </div>
              </td>
              <td>marcus.lee@example.com</td>
              <td>+1 (555) 345-6789</td>
              <td>5</td>
              <td>$3,120.00</td>
              <td class="text-right">
                <a href="#" class="button button--sm button--ghost button--neutral">View</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card__footer">
      <div class="flex justify-between items-center">
        <span class="text-sm text-muted-foreground">Showing 1 to 3 of 142 entries</span>
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
