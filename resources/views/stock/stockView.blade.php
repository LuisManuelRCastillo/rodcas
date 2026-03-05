<x-app-layout>
    <x-slot name="header">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Inventario de Productos</h2>
            <span id="totalProductos" style="font-size:.82rem;background:#fef3ec;color:#dc6336;padding:.25rem .75rem;border-radius:99px;font-weight:700;"></span>
        </div>
    </x-slot>

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        :root { --brand: #dc6336; }

        .inv-wrap { padding: 2rem 1rem; max-width: 1280px; margin: 0 auto; }

        /* Stats cards */
        .stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card {
            background: #fff; border-radius: 12px; padding: 1rem 1.25rem;
            box-shadow: 0 2px 10px rgba(0,0,0,.07); display: flex; flex-direction: column; gap: .25rem;
        }
        .stat-label { font-size: .72rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; color: #9ca3af; }
        .stat-value { font-size: 1.6rem; font-weight: 800; color: #1f2937; }
        .stat-value.brand { color: var(--brand); }
        .stat-value.green { color: #16a34a; }
        .stat-value.red   { color: #dc2626; }

        /* Table card */
        .table-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,.07); overflow: hidden; }
        .table-header { padding: 1rem 1.25rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .5rem; }
        .table-title { font-weight: 700; color: #1f2937; }

        /* DataTables overrides */
        #productosTable { width: 100% !important; border-collapse: separate; border-spacing: 0; }
        #productosTable thead th {
            background: #f9fafb !important; font-size: .72rem; font-weight: 700;
            letter-spacing: .06em; text-transform: uppercase; color: #6b7280;
            padding: .75rem 1rem !important; border-bottom: 2px solid #e5e7eb !important;
            border-top: none !important; white-space: nowrap;
        }
        #productosTable tbody tr { transition: background .15s; }
        #productosTable tbody tr:hover { background: #fef9f6 !important; }
        #productosTable tbody td { padding: .7rem 1rem !important; border-bottom: 1px solid #f3f4f6 !important; border-top: none !important; font-size: .875rem; color: #374151; vertical-align: middle; }

        /* Nombre producto */
        .prod-nombre { font-weight: 600; color: #111827; display: block; }
        .prod-codigo { font-size: .72rem; color: #9ca3af; }
        .prod-dpto   { font-size: .72rem; background: #f3f4f6; color: #6b7280; border-radius: 99px; padding: .1rem .5rem; display: inline-block; }

        /* Precios */
        .precio-venta   { font-weight: 700; color: #1f2937; }
        .precio-mayoreo { font-size: .8rem; color: #6b7280; }
        .precio-costo   { font-size: .78rem; color: #9ca3af; }

        /* Stock badge */
        .stock-badge {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .2rem .6rem; border-radius: 99px; font-size: .78rem; font-weight: 700;
        }
        .stock-ok     { background: #dcfce7; color: #16a34a; }
        .stock-low    { background: #fef9c3; color: #a16207; }
        .stock-empty  { background: #fee2e2; color: #dc2626; }
        .stock-dot    { width: 7px; height: 7px; border-radius: 50%; }
        .stock-ok   .stock-dot { background: #16a34a; }
        .stock-low  .stock-dot { background: #ca8a04; }
        .stock-empty .stock-dot { background: #dc2626; }

        /* Search override */
        div.dataTables_filter input {
            border: 1.5px solid #e5e7eb; border-radius: 8px; padding: .4rem .75rem;
            font-size: .85rem; outline: none;
        }
        div.dataTables_filter input:focus { border-color: var(--brand); }
        div.dataTables_length select { border: 1.5px solid #e5e7eb; border-radius: 8px; padding: .3rem .5rem; font-size: .85rem; }
        div.dataTables_info, div.dataTables_paginate { font-size: .82rem; padding: .75rem 1rem; }
        .paginate_button.current { background: var(--brand) !important; color: #fff !important; border-radius: 6px !important; border-color: var(--brand) !important; }
        .paginate_button:hover { background: #fef3ec !important; color: var(--brand) !important; border-color: #fef3ec !important; border-radius: 6px !important; }

        /* Responsive */
        @media(max-width: 640px) {
            .hide-mobile { display: none; }
        }
    </style>

    <div class="inv-wrap">

        {{-- Stats --}}
        @php
            $total       = $productos->count();
            $conStock    = $productos->where('existencia', '>', 0)->count();
            $sinStock    = $productos->where('existencia', '<=', 0)->count();
            $stockBajo   = $productos->filter(fn($p) => $p->existencia > 0 && $p->existencia <= ($p->inv_min ?? 5))->count();
            $deptos      = $productos->pluck('dpto')->filter()->unique()->count();
        @endphp

        <div class="stats-row">
            <div class="stat-card">
                <span class="stat-label">Total artículos</span>
                <span class="stat-value brand">{{ $total }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Con stock</span>
                <span class="stat-value green">{{ $conStock }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Sin stock</span>
                <span class="stat-value red">{{ $sinStock }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Stock bajo</span>
                <span class="stat-value" style="color:#ca8a04;">{{ $stockBajo }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Departamentos</span>
                <span class="stat-value">{{ $deptos }}</span>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-card">
            <div class="table-header">
                <span class="table-title">Catálogo completo</span>
            </div>
            <div style="overflow-x:auto;padding:1rem;">
                <table id="productosTable">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Departamento</th>
                            <th style="text-align:right;">P. Venta</th>
                            <th style="text-align:right;" class="hide-mobile">P. Mayoreo</th>
                            <th style="text-align:right;" class="hide-mobile">P. Costo</th>
                            <th style="text-align:center;">Stock</th>
                            <th style="text-align:center;" class="hide-mobile">Mín / Máx</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $p)
                        @php
                            $inv     = $p->existencia ?? 0;
                            $invMin  = $p->inv_min ?? 0;
                            if ($inv <= 0)        $sc = 'stock-empty';
                            elseif ($inv <= $invMin) $sc = 'stock-low';
                            else                     $sc = 'stock-ok';
                        @endphp
                        <tr>
                            <td>
                                <span class="prod-nombre">{{ $p->producto }}</span>
                                <span class="prod-codigo">Cód: {{ $p->codigo ?? '—' }}</span>
                            </td>
                            <td><span class="prod-dpto">{{ $p->dpto ?? '—' }}</span></td>
                            <td style="text-align:right;">
                                <span class="precio-venta">${{ number_format($p->p_venta, 2) }}</span>
                            </td>
                            <td style="text-align:right;" class="hide-mobile">
                                <span class="precio-mayoreo">${{ number_format($p->p_mayoreo, 2) }}</span>
                            </td>
                            <td style="text-align:right;" class="hide-mobile">
                                <span class="precio-costo">${{ number_format($p->p_costo ?? 0, 2) }}</span>
                            </td>
                            <td style="text-align:center;">
                                <span class="stock-badge {{ $sc }}">
                                    <span class="stock-dot"></span>
                                    {{ $inv }}
                                </span>
                            </td>
                            <td style="text-align:center;font-size:.78rem;color:#9ca3af;" class="hide-mobile">
                                {{ $p->inv_min ?? '—' }} / {{ $p->inv_max ?? '—' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        var table = $('#productosTable').DataTable({
            pageLength: 25,
            order: [[0, 'asc']],
            language: {
                decimal: '', thousands: ',',
                emptyTable: 'No hay productos registrados',
                info: 'Mostrando _START_ a _END_ de _TOTAL_ productos',
                infoEmpty: '0 productos',
                infoFiltered: '(filtrado de _MAX_)',
                lengthMenu: 'Mostrar _MENU_',
                search: 'Buscar:',
                zeroRecords: 'Sin resultados',
                paginate: { first: '«', last: '»', next: '›', previous: '‹' }
            },
            dom: '<"flex flex-wrap justify-between items-center gap-2 mb-3"<"text-sm"l><"text-sm"f>>rt<"flex flex-wrap justify-between items-center gap-2 pt-2"<"text-sm text-gray-500"i><"text-sm"p>>',
            columnDefs: [
                { orderable: false, targets: [] }
            ],
            drawCallback: function () {
                var info = this.api().page.info();
                document.getElementById('totalProductos').textContent = info.recordsTotal + ' productos';
            }
        });
    });
    </script>
</x-app-layout>
