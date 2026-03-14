<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Solicitudes de Factura
        </h2>
    </x-slot>

    <style>
        :root { --brand: #dc6336; --brand-dark: #b84e27; }

        .panel-wrap {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1.25rem;
        }

        .stats-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .stat-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,.07);
            padding: 1.1rem 1.5rem;
            flex: 1;
            min-width: 120px;
        }
        .stat-label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: #9ca3af; }
        .stat-value { font-size: 1.9rem; font-weight: 800; color: #111827; margin-top: .15rem; }
        .stat-value.orange { color: var(--brand); }
        .stat-value.green  { color: #059669; }

        /* ── Filtros ── */
        .filter-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        .filter-tabs { display: flex; gap: .5rem; }
        .filter-tab {
            padding: .35rem .9rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid #e5e7eb;
            background: #fff;
            color: #6b7280;
            text-decoration: none;
            transition: all .15s;
        }
        .filter-tab.active, .filter-tab:hover { border-color: var(--brand); color: var(--brand); background: #fef3ec; }

        /* ── Tarjetas de solicitud ── */
        .solicitud-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,.07);
            margin-bottom: 1rem;
            overflow: hidden;
            border: 1.5px solid #f3f4f6;
            transition: box-shadow .15s;
        }
        .solicitud-card:hover { box-shadow: 0 4px 18px rgba(0,0,0,.1); }

        .solicitud-main {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 1rem;
            padding: 1rem 1.25rem;
            cursor: pointer;
        }

        /* Columna izquierda */
        .sol-left {}
        .sol-header {
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: .55rem;
            flex-wrap: wrap;
        }
        .sol-id { font-size: .72rem; color: #9ca3af; }
        .ticket-chip {
            font-family: monospace;
            background: #f3f4f6;
            padding: .15rem .55rem;
            border-radius: 5px;
            font-size: .85rem;
            font-weight: 700;
            color: #1f2937;
            letter-spacing: .04em;
        }
        .sol-fecha { font-size: .75rem; color: #9ca3af; }

        .sol-nombre { font-size: .95rem; font-weight: 700; color: #111827; margin-bottom: .3rem; }
        .sol-email { font-size: .8rem; color: var(--brand); text-decoration: none; }
        .sol-email:hover { text-decoration: underline; }

        .sol-meta {
            display: flex;
            flex-wrap: wrap;
            gap: .4rem .75rem;
            margin-top: .5rem;
        }
        .meta-item { font-size: .75rem; color: #6b7280; }
        .meta-item strong { color: #374151; }

        /* Columna derecha */
        .sol-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
            gap: .75rem;
            min-width: 160px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: .28rem .75rem;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 700;
        }
        .badge.pendiente { background: #fef3c7; color: #92400e; }
        .badge.completada { background: #d1fae5; color: #065f46; }

        .sol-total-wrap { text-align: right; }
        .sol-total-label { font-size: .65rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; }
        .sol-total-value { font-size: 1.35rem; font-weight: 800; color: #111827; }

        .sol-pago {
            font-size: .72rem;
            color: #6b7280;
            text-align: right;
        }
        .pago-chip {
            display: inline-block;
            background: #f0f9ff;
            color: #0369a1;
            border-radius: 5px;
            padding: .15rem .5rem;
            font-size: .72rem;
            font-weight: 600;
        }

        .btn-completar {
            padding: .45rem 1.1rem;
            background: var(--brand);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: .8rem;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s;
            white-space: nowrap;
        }
        .btn-completar:hover { background: var(--brand-dark); }

        /* Detalle expandible */
        .solicitud-detalle {
            border-top: 1px solid #f3f4f6;
            background: #fafafa;
            padding: .85rem 1.25rem 1rem;
            display: none;
        }
        .detalle-title {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: #9ca3af;
            margin-bottom: .5rem;
        }
        .detalle-table { width: 100%; border-collapse: collapse; font-size: .82rem; }
        .detalle-table th {
            text-align: left;
            padding: .3rem .5rem;
            color: #6b7280;
            font-weight: 600;
            border-bottom: 1px solid #e5e7eb;
        }
        .detalle-table th.r { text-align: right; }
        .detalle-table td { padding: .35rem .5rem; border-bottom: 1px solid #f3f4f6; color: #374151; }
        .detalle-table td.c { text-align: center; color: #6b7280; }
        .detalle-table td.r { text-align: right; color: #6b7280; }
        .detalle-table td.total { text-align: right; font-weight: 600; color: var(--brand); }
        .detalle-table tfoot td {
            border-top: 2px solid #e5e7eb;
            border-bottom: none;
            font-weight: 700;
            color: #111827;
            text-align: right;
        }

        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
            color: #9ca3af;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,.07);
        }
        .empty-state svg { margin-bottom: .75rem; opacity: .4; }
        .empty-state p { font-size: .9rem; }

        .expand-icon {
            font-size: .8rem;
            color: #9ca3af;
            margin-left: .3rem;
            transition: transform .2s;
        }
        .expand-icon.open { transform: rotate(180deg); }
    </style>

    <div class="panel-wrap">

        {{-- Stats --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-label">Total solicitudes</div>
                <div class="stat-value">{{ $solicitudes->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Pendientes</div>
                <div class="stat-value orange">{{ $solicitudes->where('estatus','pendiente')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Completadas</div>
                <div class="stat-value green">{{ $solicitudes->where('estatus','completada')->count() }}</div>
            </div>
        </div>

        {{-- Filtros --}}
        <div class="filter-bar">
            <div class="filter-tabs">
                <a href="{{ route('facturas.panel') }}" class="filter-tab {{ !request('filtro') ? 'active' : '' }}">Todas</a>
                <a href="{{ route('facturas.panel', ['filtro'=>'pendiente']) }}" class="filter-tab {{ request('filtro')=='pendiente' ? 'active' : '' }}">Pendientes</a>
                <a href="{{ route('facturas.panel', ['filtro'=>'completada']) }}" class="filter-tab {{ request('filtro')=='completada' ? 'active' : '' }}">Completadas</a>
            </div>
        </div>

        @php
            $lista = request('filtro')
                ? $solicitudes->where('estatus', request('filtro'))
                : $solicitudes;
        @endphp

        @if($lista->isEmpty())
            <div class="empty-state">
                <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p>No hay solicitudes {{ request('filtro') ? request('filtro').'s' : '' }} aún.</p>
            </div>
        @else
            @foreach($lista as $s)
            <div class="solicitud-card">
                <div class="solicitud-main" onclick="toggleDetalle({{ $s->id }}, this)">
                    {{-- Izquierda: datos del solicitante --}}
                    <div class="sol-left">
                        <div class="sol-header">
                            <span class="sol-id">#{{ $s->id }}</span>
                            @if($s->id_venta && isset($s->venta))
                                <span class="ticket-chip">{{ $s->venta->invoice_number }}</span>
                            @elseif($s->id_venta)
                                <span class="ticket-chip">#{{ $s->id_venta }}</span>
                            @endif
                            <span class="sol-fecha">{{ $s->created_at->format('d/m/Y H:i') }}</span>
                            <span class="expand-icon" id="icon-{{ $s->id }}">▼</span>
                        </div>

                        <div class="sol-nombre">{{ $s->nombre }}</div>
                        <a href="mailto:{{ $s->email }}" class="sol-email" onclick="event.stopPropagation()">{{ $s->email }}</a>

                        <div class="sol-meta">
                            <span class="meta-item"><strong>RFC:</strong> {{ $s->rfc }}</span>
                            <span class="meta-item"><strong>C.P.:</strong> {{ $s->codigo_postal }}</span>
                            <span class="meta-item"><strong>Régimen:</strong> {{ $s->regimen_fiscal }}</span>
                            <span class="meta-item"><strong>CFDI:</strong> {{ $s->uso_cfdi }}</span>
                        </div>
                    </div>

                    {{-- Derecha: total, forma de pago, estatus, acción --}}
                    <div class="sol-right" onclick="event.stopPropagation()">
                        <span class="badge {{ $s->estatus }}">{{ ucfirst($s->estatus) }}</span>

                        @if(isset($s->venta))
                            <div class="sol-total-wrap">
                                <div class="sol-total-label">Total</div>
                                <div class="sol-total-value">${{ number_format($s->venta->total, 2) }}</div>
                            </div>
                            @if(!empty($s->venta->payment_method))
                                <div class="sol-pago">
                                    Pago: <span class="pago-chip">{{ $s->venta->payment_method }}</span>
                                </div>
                            @endif
                        @endif

                        @if($s->estatus === 'pendiente')
                            <form method="POST" action="{{ route('facturas.completar', $s->id) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-completar">Marcar lista</button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- Detalle expandible --}}
                <div class="solicitud-detalle" id="detalle-{{ $s->id }}">
                    @if(!empty($s->detalles) && count($s->detalles))
                        <div class="detalle-title">
                            Detalle de compra
                            @if(isset($s->venta)) — {{ $s->venta->invoice_number }} &nbsp;·&nbsp; {{ \Carbon\Carbon::parse($s->venta->sale_date)->format('d/m/Y H:i') }} @endif
                        </div>
                        <table class="detalle-table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th class="r" style="width:60px">Cant.</th>
                                    <th class="r" style="width:90px">P. Unit.</th>
                                    <th class="r" style="width:90px">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($s->detalles as $d)
                                <tr>
                                    <td>{{ $d->product_name }}</td>
                                    <td class="c">{{ $d->quantity }}</td>
                                    <td class="r">${{ number_format($d->unit_price, 2) }}</td>
                                    <td class="total">${{ number_format($d->total, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            @if(isset($s->venta))
                            <tfoot>
                                <tr>
                                    <td colspan="3" style="padding:.4rem .5rem;">Total</td>
                                    <td style="padding:.4rem .5rem;">${{ number_format($s->venta->total, 2) }}</td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    @else
                        <span style="color:#9ca3af;font-size:.82rem;">Sin detalle de compra registrado.</span>
                    @endif
                </div>
            </div>
            @endforeach
        @endif

    </div>

<script>
function toggleDetalle(id, mainEl) {
    const detalle = document.getElementById('detalle-' + id);
    const icon = document.getElementById('icon-' + id);
    const open = detalle.style.display === 'block';
    detalle.style.display = open ? 'none' : 'block';
    if (icon) icon.classList.toggle('open', !open);
}
</script>

</x-app-layout>
