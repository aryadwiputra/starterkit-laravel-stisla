<div class="card">
    @if($caption || $slot->isNotEmpty())
    <div class="card__header">
        @if($caption)
        <h3 class="card__title">{{ $caption }}</h3>
        @endif
        {{ $slot }}
    </div>
    @endif
    <div class="card__body p-0">
        <div class="table-responsive">
            <table id="{{ $id }}" class="{{ $tableClasses() }}" style="width: 100%">
                <thead>
                    <tr class="table__row">
                        @if($checkbox)
                        <th class="w-4">
                            <input class="checkbox" type="checkbox" data-check-all />
                        </th>
                        @endif
                        @foreach($columns as $column)
                        <th
                            @isset($column['class']) class="{{ $column['class'] }}" @endisset
                            @isset($column['style']) style="{{ $column['style'] }}" @endisset
                        >
                            {{ $column['label'] ?? '' }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
(function() {
    'use strict';

    var tableId = '{{ $id }}';
    var table = document.getElementById(tableId);

    if (!table) return;

    var dt = $(table).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ $dataRoute }}',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            }
        },
        columns: [
            @if($checkbox)
            { data: 'id', name: 'id', searchable: false, orderable: false, className: 'w-4' },
            @endif
            @foreach($columns as $index => $column)
            {
                data: '{{ $column['name'] }}',
                name: '{{ $column['name'] }}',
                searchable: {{ isset($column['searchable']) ? ($column['searchable'] ? 'true' : 'false') : 'true' }},
                orderable: {{ isset($column['sortable']) ? ($column['sortable'] ? 'true' : 'false') : 'true' }},
                @isset($column['class'])
                className: '{{ $column['class'] }}',
                @endisset
                @isset($column['render'])
                render: function(data, type, row) {
                    {!! $column['render'] !!}
                },
                @endisset
            },
            @endforeach
        ],
        order: [[0, 'desc']],
        language: {
            emptyTable: '{{ $emptyMessage }}',
            processing: '<span class="spinner spinner--border"></span> Loading...',
            lengthMenu: 'Show _MENU_ entries',
            info: 'Showing _START_ to _END_ of _TOTAL_ entries',
            paginate: {
                first: 'First',
                last: 'Last',
                next: 'Next',
                previous: 'Previous'
            },
            search: 'Search:'
        },
        dom: '<"flex justify-between items-center mb-4"<"length"l><"search"f>>rt<"flex justify-between items-center mt-4"<"info"i><"pagination"p>>',
        initComplete: function(settings, json) {
            // Custom styling hook
        }
    });

    // Check all checkbox
    @if($checkbox)
    document.querySelector('[data-check-all]')?.addEventListener('change', function(e) {
        document.querySelectorAll('[data-check-row]').forEach(function(checkbox) {
            checkbox.checked = e.target.checked;
            checkbox.closest('tr').setAttribute('data-state', e.target.checked ? 'active' : '');
        });
    });

    document.querySelectorAll('[data-check-row]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function(e) {
            e.target.closest('tr').setAttribute('data-state', e.target.checked ? 'active' : '');
        });
    });
    @endif

    // Expose table instance globally
    window[tableId + 'Instance'] = dt;
})();
</script>
@endpush
