<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotización N° {{ $cotizacion->id_cotizacion }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #1f2937;
            background: #fff;
        }

        /* ── Header ── */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 18px;
            border-bottom: 3px solid #dc6336;
            padding-bottom: 14px;
        }
        .header-logo { display: table-cell; width: 200px; vertical-align: middle; }
        .header-logo img { width: 180px; }
        .header-info {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            color: #4b5563;
            line-height: 1.55;
            font-size: 10px;
        }
        .header-info strong { color: #1f2937; }

        /* ── Folio badge ── */
        .folio-badge {
            background: #dc6336;
            color: #fff;
            font-weight: bold;
            font-size: 13px;
            padding: 4px 14px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 4px;
        }

        /* ── Cliente / fecha ── */
        .meta-row {
            display: table;
            width: 100%;
            margin-bottom: 14px;
            background: #f9fafb;
            border-radius: 6px;
            padding: 10px 14px;
            border-left: 4px solid #dc6336;
        }
        .meta-col { display: table-cell; vertical-align: top; width: 50%; }
        .meta-label { font-size: 9px; text-transform: uppercase; letter-spacing: .06em; color: #9ca3af; font-weight: 700; margin-bottom: 2px; }
        .meta-value { font-size: 11.5px; font-weight: 700; color: #111827; }
        .meta-sub   { font-size: 10px; color: #6b7280; margin-top: 1px; }

        /* ── Tabla de productos ── */
        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        table.items thead tr {
            background: #dc6336;
            color: #fff;
        }
        table.items thead th {
            padding: 7px 10px;
            text-align: left;
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
        }
        table.items thead th.right { text-align: right; }
        table.items tbody tr:nth-child(even) { background: #fafafa; }
        table.items tbody tr:nth-child(odd)  { background: #fff; }
        table.items tbody td {
            padding: 7px 10px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 10.5px;
            vertical-align: middle;
        }
        table.items tbody td.right { text-align: right; }
        table.items tbody td .badge-manual {
            font-size: 8px;
            background: #fef3ec;
            color: #dc6336;
            border: 1px solid #f0a47a;
            border-radius: 99px;
            padding: 0 4px;
            margin-left: 4px;
            vertical-align: middle;
        }

        /* ── Totales ── */
        .totals-wrap {
            float: right;
            width: 240px;
            margin-bottom: 20px;
        }
        .totals-wrap table { width: 100%; border-collapse: collapse; }
        .totals-wrap td { padding: 4px 8px; font-size: 10.5px; }
        .totals-wrap td:last-child { text-align: right; font-weight: 600; }
        .totals-wrap tr.iva td { color: #6b7280; }
        .totals-wrap tr.grand td {
            border-top: 2px solid #dc6336;
            font-size: 13px;
            font-weight: 800;
            color: #dc6336;
            padding-top: 6px;
        }
        .clearfix::after { content: ''; display: table; clear: both; }

        /* ── Nota al pie ── */
        .footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
            margin-top: 20px;
            font-size: 9px;
            color: #9ca3af;
            text-align: center;
            line-height: 1.6;
        }
        .footer strong { color: #6b7280; }
    </style>
</head>
<body>

    {{-- ── Encabezado ── --}}
    <div class="header">
        <div class="header-logo">
            <img src="{{ public_path('assets/img/logoSF.png') }}" alt="RODCAS">
        </div>
        <div class="header-info">
            <span class="folio-badge">Cotización N° {{ $cotizacion->id_cotizacion }}</span><br>
            <strong>Ferretería RODCAS</strong><br>
            Calle Miguel Hidalgo 847, Col. La Providencia<br>
            Metepec, Estado de México<br>
            Tel: 722 706 0685 &nbsp;|&nbsp; 720 829 3653<br>
            ferreteriarodcas@gmail.com
        </div>
    </div>

    {{-- ── Cliente / Fecha ── --}}
    <div class="meta-row">
        <div class="meta-col">
            <div class="meta-label">Cliente</div>
            <div class="meta-value">{{ $cotizacion->cliente->name ?? 'N/A' }}</div>
            @if(!empty($cotizacion->cliente->phone))
                <div class="meta-sub">Tel: {{ $cotizacion->cliente->phone }}</div>
            @endif
            @if(!empty($cotizacion->cliente->email))
                <div class="meta-sub">{{ $cotizacion->cliente->email }}</div>
            @endif
        </div>
        <div class="meta-col" style="text-align:right;">
            <div class="meta-label">Fecha</div>
            <div class="meta-value">{{ \Carbon\Carbon::parse($cotizacion->fecha)->format('d / m / Y') }}</div>
            <div class="meta-sub">Estatus: {{ ucfirst($cotizacion->estatus ?? 'pendiente') }}</div>
        </div>
    </div>

    {{-- ── Tabla de productos ── --}}
    <table class="items">
        <thead>
            <tr>
                <th style="width:5%;">#</th>
                <th style="width:50%;">Producto / Descripción</th>
                <th style="width:10%;" class="right">Cant.</th>
                <th style="width:17%;" class="right">Precio Unit.</th>
                <th style="width:18%;" class="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cotizacion->detalles as $i => $detalle)
            @php
                // Prioridad: descripcion guardada → nombre del producto en BD → N/A
                $nombre = $detalle->descripcion
                    ?: ($detalle->producto->producto ?? 'N/A');
                $esManual = is_null($detalle->id_producto);
                $sub = $detalle->cantidad * $detalle->precio_unitario;
            @endphp
            <tr>
                <td style="color:#9ca3af;">{{ $i + 1 }}</td>
                <td>
                    {{ $nombre }}
                    @if($esManual)
                        <span class="badge-manual">personalizado</span>
                    @endif
                </td>
                <td class="right">{{ $detalle->cantidad }}</td>
                <td class="right">${{ number_format($detalle->precio_unitario, 2) }}</td>
                <td class="right">${{ number_format($sub, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ── Totales ── --}}
    <div class="clearfix">
        <div class="totals-wrap">
            <table>
                <tr class="grand">
                    <td>Total</td>
                    <td>${{ number_format($cotizacion->total, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ── Pie ── --}}
    <div class="footer">
        <strong>Facturas:</strong> ferreteriarodcasfacturas@gmail.com &nbsp;|&nbsp;
        Cotización válida por 15 días naturales a partir de la fecha de emisión.<br>
        Precios en pesos mexicanos (MXN) con IVA incluido. Sujeto a disponibilidad de inventario.
    </div>

</body>
</html>
