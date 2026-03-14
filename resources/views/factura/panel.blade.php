<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Solicitudes de Factura
        </h2>
    </x-slot>

    <style>
        :root { --brand: #dc6336; --brand-dark: #b84e27; }

        .panel-wrap {
            max-width: 1100px;
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

        .card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
        }
        .card-header-title {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: #6b7280;
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

        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: .75rem 1rem;
            text-align: left;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: #9ca3af;
            background: #fafafa;
            border-bottom: 1px solid #f3f4f6;
        }
        tbody td {
            padding: .9rem 1rem;
            font-size: .875rem;
            color: #374151;
            border-bottom: 1px solid #f9fafb;
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #fafafa; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .25rem .7rem;
            border-radius: 999px;
            font-size: .72rem;
            font-weight: 700;
        }
        .badge.pendiente { background: #fef3c7; color: #92400e; }
        .badge.completada { background: #d1fae5; color: #065f46; }

        .btn-completar {
            padding: .35rem .9rem;
            background: var(--brand);
            color: #fff;
            border: none;
            border-radius: 7px;
            font-size: .78rem;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
        }
        .btn-completar:hover { background: var(--brand-dark); }

        .empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
            color: #9ca3af;
        }
        .empty-state svg { margin-bottom: .75rem; opacity: .4; }
        .empty-state p { font-size: .9rem; }

        .rfc-chip {
            font-family: monospace;
            background: #f3f4f6;
            padding: .15rem .5rem;
            border-radius: 5px;
            font-size: .85rem;
            color: #1f2937;
            letter-spacing: .05em;
        }

        .fecha-col { color: #6b7280; font-size: .8rem; white-space: nowrap; }
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

        {{-- Tabla --}}
        <div class="card">
            <div class="card-header">
                <span class="card-header-title">Solicitudes recibidas</span>
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
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>RFC</th>
                            <th>Nombre / Razón Social</th>
                            <th>C.P.</th>
                            <th>Régimen</th>
                            <th>Uso CFDI</th>
                            <th>Correo</th>
                            <th>Fecha</th>
                            <th>Estatus</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lista as $s)
                        <tr>
                            <td style="color:#9ca3af;font-size:.78rem;">{{ $s->id }}</td>
                            <td><span class="rfc-chip">{{ $s->rfc }}</span></td>
                            <td><strong>{{ $s->nombre }}</strong></td>
                            <td>{{ $s->codigo_postal }}</td>
                            <td style="font-size:.8rem;">{{ $s->regimen_fiscal }}</td>
                            <td style="font-size:.8rem;">{{ $s->uso_cfdi }}</td>
                            <td>
                                <a href="mailto:{{ $s->email }}" style="color:var(--brand);text-decoration:none;">
                                    {{ $s->email }}
                                </a>
                            </td>
                            <td class="fecha-col">{{ $s->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $s->estatus }}">
                                    {{ ucfirst($s->estatus) }}
                                </span>
                            </td>
                            <td>
                                @if($s->estatus === 'pendiente')
                                    <form method="POST" action="{{ route('facturas.completar', $s->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn-completar">Marcar lista</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</x-app-layout>
