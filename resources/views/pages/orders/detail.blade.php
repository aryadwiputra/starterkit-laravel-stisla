@extends('layouts.app')

@section('content')
<header class="page__header">
  <div class="flex items-center gap-3">
    <a href="{{ route('orders.index') }}" class="button button--ghost button--neutral button--icon-only">
      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
        <path fill="none" stroke="currentColor" stroke-width="1.5" d="m15 19l-7-7 7-7"/>
      </svg>
    </a>
    <div>
      <h1 class="page__title">Order #{{ $id }}</h1>
      <p class="text-muted-foreground mt-1">Order details and tracking information.</p>
    </div>
  </div>
  <div class="flex gap-2">
    <button class="button button--outline button--neutral">Print Invoice</button>
    <button class="button button--danger button--outline">Cancel Order</button>
  </div>
</header>

<div class="page__body">
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 xl:col-span-8">
      {{-- Order Items --}}
      <div class="card">
        <div class="card__header">
          <h3 class="card__title">Order Items</h3>
          <span class="badge badge--soft badge--warning">Pending</span>
        </div>
        <div class="card__body p-0">
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th class="text-right">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="media items-center gap-3">
                      <span class="avatar avatar--md avatar--rounded">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                      </span>
                      <span>Headphone Blitz</span>
                    </div>
                  </td>
                  <td>$199.00</td>
                  <td>2</td>
                  <td class="text-right">$398.00</td>
                </tr>
                <tr>
                  <td>
                    <div class="media items-center gap-3">
                      <span class="avatar avatar--md avatar--rounded">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                      </span>
                      <span>Smart Watch X</span>
                    </div>
                  </td>
                  <td>$299.00</td>
                  <td>1</td>
                  <td class="text-right">$299.00</td>
                </tr>
                <tr>
                  <td>
                    <div class="media items-center gap-3">
                      <span class="avatar avatar--md avatar--rounded">
                        <img src="https://images.unsplash.com/photo-1491553895911-0055uj63d07a?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
                      </span>
                      <span>Minimal Desk</span>
                    </div>
                  </td>
                  <td>$543.00</td>
                  <td>1</td>
                  <td class="text-right">$543.00</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3" class="text-right">Subtotal</td>
                  <td class="text-right">$1,240.00</td>
                </tr>
                <tr>
                  <td colspan="3" class="text-right">Shipping</td>
                  <td class="text-right">$0.00</td>
                </tr>
                <tr class="font-bold">
                  <td colspan="3" class="text-right">Total</td>
                  <td class="text-right">$1,240.00</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>

      {{-- Timeline --}}
      <div class="card mt-4">
        <div class="card__header">
          <h3 class="card__title">Order Timeline</h3>
        </div>
        <div class="card__body">
          <ul class="timeline">
            <li class="timeline__item timeline__item--active">
              <div class="timeline__marker"></div>
              <div class="timeline__content">
                <div class="timeline__title">Order placed</div>
                <div class="timeline__time">15 Aug 2026, 10:30 AM</div>
              </div>
            </li>
            <li class="timeline__item">
              <div class="timeline__marker"></div>
              <div class="timeline__content">
                <div class="timeline__title">Payment confirmed</div>
                <div class="timeline__time">15 Aug 2026, 10:35 AM</div>
              </div>
            </li>
            <li class="timeline__item">
              <div class="timeline__marker"></div>
              <div class="timeline__content">
                <div class="timeline__title">Processing</div>
                <div class="timeline__time">Pending</div>
              </div>
            </li>
            <li class="timeline__item">
              <div class="timeline__marker"></div>
              <div class="timeline__content">
                <div class="timeline__title">Shipped</div>
                <div class="timeline__time">-</div>
              </div>
            </li>
            <li class="timeline__item">
              <div class="timeline__marker"></div>
              <div class="timeline__content">
                <div class="timeline__title">Delivered</div>
                <div class="timeline__time">-</div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-span-12 xl:col-span-4">
      {{-- Customer Info --}}
      <div class="card">
        <div class="card__header">
          <h3 class="card__title">Customer</h3>
        </div>
        <div class="card__body">
          <div class="media items-center gap-3 mb-4">
            <span class="avatar avatar--lg avatar--circle">
              <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=facearea&facepad=2.5&w=80&h=80&q=80" alt=""/>
            </span>
            <div>
              <div class="font-medium">Acme Corp</div>
              <div class="text-sm text-muted-foreground">Customer since 2024</div>
            </div>
          </div>
          <div class="flex flex-col gap-3">
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M2 12c0-3.771 0-5.657 1.172-6.828S6.229 4 10 4h4c3.771 0 5.657 0 6.828 1.172S22 8.229 22 12"/>
              </svg>
              <span class="text-sm">contact@acmecorp.com</span>
            </div>
            <div class="flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
              <span class="text-sm">+1 (555) 123-4567</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Shipping Address --}}
      <div class="card mt-4">
        <div class="card__header">
          <h3 class="card__title">Shipping Address</h3>
        </div>
        <div class="card__body">
          <address class="not-italic">
            <div class="font-medium">Acme Corporation</div>
            <div>123 Business Avenue</div>
            <div>Suite 456</div>
            <div>San Francisco, CA 94102</div>
            <div>United States</div>
          </address>
        </div>
      </div>

      {{-- Payment Info --}}
      <div class="card mt-4">
        <div class="card__header">
          <h3 class="card__title">Payment</h3>
        </div>
        <div class="card__body">
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-muted-foreground">Method</span>
            <span class="badge">Credit Card</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-sm text-muted-foreground">Status</span>
            <span class="badge badge--soft badge--success">Paid</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
