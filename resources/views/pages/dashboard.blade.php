@extends('layouts.app')

@section('content')
<header class="page__header">
  <h1 class="page__title">Welcome back, <span>Steven</span> 👋</h1>
</header>

<div class="page__body">
  <section class="page__section">
    <div class="grid grid-cols-12 gap-4">
      {{-- Order Statistics Card --}}
      <div class="col-span-12 xl:col-span-4">
        <div class="card card--stat">
          <div class="card__body">
            <div class="card__title">Order Statistics</div>

            <div class="stat">
              <div class="stat__value">59</div>
              <div class="stat__meta">
                <span class="stat__label text-eyebrow">Total Orders · This Month</span>
                <span class="badge badge--soft badge--success">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19 15l-7-6l-7 6"/>
                  </svg>
                  11%
                </span>
              </div>
            </div>

            <div class="meter meter--block meter--lg meter--stat">
              <div class="meter__track">
                <span class="meter__bar meter__bar--warning" style="width: 41%"></span>
                <span class="meter__bar meter__bar--primary" style="width: 20%"></span>
                <span class="meter__bar meter__bar--success" style="width: 39%"></span>
              </div>
            </div>

            <div class="stat-detail">
              <div class="stat-detail__col">
                <span class="stat-detail__label text-eyebrow">
                  <span class="indicator indicator--warning"></span>
                  Pending
                </span>
                <span class="stat-detail__value">24</span>
                <span class="stat-detail__pct">41%</span>
              </div>

              <div class="stat-detail__col">
                <span class="stat-detail__label text-eyebrow">
                  <span class="indicator indicator--primary"></span>
                  Shipping
                </span>
                <span class="stat-detail__value">12</span>
                <span class="stat-detail__pct">20%</span>
              </div>

              <div class="stat-detail__col">
                <span class="stat-detail__label text-eyebrow">
                  <span class="indicator indicator--success"></span>
                  Completed
                </span>
                <span class="stat-detail__value">23</span>
                <span class="stat-detail__pct">39%</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Revenue Card --}}
      <div class="col-span-12 sm:col-span-6 xl:col-span-4">
        <div class="card card--stat">
          <div class="card__body">
            <div class="flex justify-between items-center">
              <span class="icon-box icon-box--primary icon-box--lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                  <g fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/>
                    <path stroke-linecap="round" d="M12 17v1m0-12v1m3 2.5C15 8.12 13.657 7 12 7S9 8.12 9 9.5s1.343 2.5 3 2.5s3 1.12 3 2.5s-1.343 2.5-3 2.5s-3-1.12-3-2.5"/>
                  </g>
                </svg>
              </span>
              <span class="badge badge--soft badge--success">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19 15l-7-6l-7 6"/>
                </svg>
                18%
              </span>
            </div>

            <div class="stat">
              <div class="stat__value">$8,459</div>
              <div class="stat__meta">
                <span class="stat__label text-eyebrow">Revenue · This Month</span>
              </div>
            </div>

            <div class="flex justify-between text-xs text-muted-foreground mt-3">
              <span>vs. last month</span>
              <span>$7,172</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Customer Card --}}
      <div class="col-span-12 sm:col-span-6 xl:col-span-4">
        <div class="card card--stat">
          <div class="card__body">
            <div class="flex justify-between items-center">
              <span class="icon-box icon-box--warning icon-box--lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill="currentColor" d="M16.807 19.011A8.46 8.46 0 0 1 12 20.5a8.46 8.46 0 0 1-4.807-1.489c-.604-.415-.862-1.205-.51-1.848C7.41 15.83 8.91 15 12 15s4.59.83 5.318 2.163c.35.643.093 1.433-.511 1.848M12 12a3 3 0 1 0 0-6a3 3 0 0 0 0 6" opacity=".5"/>
                  <path fill="currentColor" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10"/>
                </svg>
              </span>
              <span class="badge badge--soft badge--success">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19 15l-7-6l-7 6"/>
                </svg>
                6%
              </span>
            </div>

            <div class="stat">
              <div class="stat__value">142</div>
              <div class="stat__meta">
                <span class="stat__label text-eyebrow">Total Customers</span>
              </div>
            </div>

            <div class="flex justify-between text-xs text-muted-foreground mt-3">
              <span>vs. last month</span>
              <span>134</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="page__section">
    <div class="grid grid-cols-12 gap-4">
      {{-- Recent Orders Table --}}
      <div class="col-span-12 xl:col-span-8">
        <div class="card">
          <div class="card__header">
            <h3 class="card__title">Recent Orders</h3>
            <a href="{{ route('orders.index') }}" class="button button--sm button--ghost button--primary">View all</a>
          </div>
          <div class="card__body p-0">
            <div class="table-wrapper">
              <table class="table">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
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
                  </tr>
                  <tr>
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
                  </tr>
                  <tr>
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
                  </tr>
                  <tr>
                    <td><a href="{{ route('orders.show', 10425) }}">#10425</a></td>
                    <td>
                      <div class="media items-center gap-3">
                        <span class="avatar avatar--sm avatar--circle">
                          <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                        </span>
                        <span>Priya Patel</span>
                      </div>
                    </td>
                    <td><span class="badge badge--soft badge--success">Completed</span></td>
                    <td>$680.00</td>
                    <td>12 Aug 2026</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- Top Products --}}
      <div class="col-span-12 xl:col-span-4">
        <div class="card">
          <div class="card__header">
            <h3 class="card__title">Top Products</h3>
            <a href="{{ route('products.index') }}" class="button button--sm button--ghost button--primary">View all</a>
          </div>
          <div class="card__body">
            <ul class="list-space-y-4">
              <li class="list-space__item">
                <div class="flex justify-between items-center">
                  <div class="media items-center gap-3">
                    <span class="avatar avatar--md avatar--rounded">
                      <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                    </span>
                    <div>
                      <div class="font-medium">Headphone Blitz</div>
                      <div class="text-xs text-muted-foreground">Electronics</div>
                    </div>
                  </div>
                  <div class="text-right">
                    <div class="font-medium">48 sold</div>
                    <div class="text-xs text-muted-foreground">$2,399</div>
                  </div>
                </div>
              </li>
              <li class="list-space__item">
                <div class="flex justify-between items-center">
                  <div class="media items-center gap-3">
                    <span class="avatar avatar--md avatar--rounded">
                      <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                    </span>
                    <div>
                      <div class="font-medium">Smart Watch X</div>
                      <div class="text-xs text-muted-foreground">Electronics</div>
                    </div>
                  </div>
                  <div class="text-right">
                    <div class="font-medium">36 sold</div>
                    <div class="text-xs text-muted-foreground">$1,799</div>
                  </div>
                </div>
              </li>
              <li class="list-space__item">
                <div class="flex justify-between items-center">
                  <div class="media items-center gap-3">
                    <span class="avatar avatar--md avatar--rounded">
                      <img src="https://images.unsplash.com/photo-1491553895911-0055uj63d07a?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                    </span>
                    <div>
                      <div class="font-medium">Minimal Desk</div>
                      <div class="text-xs text-muted-foreground">Furniture</div>
                    </div>
                  </div>
                  <div class="text-right">
                    <div class="font-medium">28 sold</div>
                    <div class="text-xs text-muted-foreground">$1,399</div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
