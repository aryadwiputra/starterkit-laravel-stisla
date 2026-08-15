@extends('layouts.app')

@section('content')
<header class="page__header">
  <div>
    <h1 class="page__title">Reports</h1>
    <p class="text-muted-foreground mt-1">Analytics and insights for your store.</p>
  </div>
  <button class="button button--outline button--neutral">
    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
      <path fill="none" stroke="currentColor" stroke-width="1.5" d="M4 16v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M8 12l4-4 4 4M12 8v8"/>
    </svg>
    Export Report
  </button>
</header>

<div class="page__body">
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 xl:col-span-4">
      <div class="card card--stat">
        <div class="card__body">
          <div class="card__title">Total Revenue</div>
          <div class="stat">
            <div class="stat__value">$15,673</div>
            <div class="stat__meta">
              <span class="badge badge--soft badge--success">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19 15l-7-6l-7 6"/>
                </svg>
                18%
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-span-12 xl:col-span-4">
      <div class="card card--stat">
        <div class="card__body">
          <div class="card__title">Total Orders</div>
          <div class="stat">
            <div class="stat__value">59</div>
            <div class="stat__meta">
              <span class="badge badge--soft badge--success">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19 15l-7-6l-7 6"/>
                </svg>
                11%
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-span-12 xl:col-span-4">
      <div class="card card--stat">
        <div class="card__body">
          <div class="card__title">Avg. Order Value</div>
          <div class="stat">
            <div class="stat__value">$265.64</div>
            <div class="stat__meta">
              <span class="badge badge--soft badge--success">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" aria-hidden="true">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19 15l-7-6l-7 6"/>
                </svg>
                6%
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mt-4">
    <div class="card__header">
      <h3 class="card__title">Revenue Overview</h3>
      <div class="flex gap-2">
        <select class="input w-auto">
          <option>Last 7 days</option>
          <option selected>Last 30 days</option>
          <option>Last 90 days</option>
          <option>This year</option>
        </select>
      </div>
    </div>
    <div class="card__body">
      <div class="chart-container" style="height: 300px;">
        <div id="revenueChart" class="w-full h-full"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('js/meridian/charts.js') }}"></script>
@endpush
