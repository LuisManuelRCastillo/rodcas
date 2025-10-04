<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotización N° {{ $cotizacion->id_cotizacion }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        .total { text-align: right; }
        .header-table td { border: none; vertical-align: top; font-size: 12px; }
        .header-logo { width: 150px; }
        .header-info { font-size: 12px; line-height: 1.2; }
    </style>
</head>
<body>
    <!-- Encabezado usando tabla -->
    <div style="text-align: center; margin-bottom: 20px;">
       <img src="{{ public_path('assets/img/logoSF.png') }}" style="width: 300px;">
    </div>
    <table class="header-table">
        <tr>
            <td>
                <p style="font-size: 12px;">{{ $cotizacion->cliente->nombre ?? 'N/A' }}</p>
                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($cotizacion->fecha)->format('d-m-Y') }}</p>
            </td>
            <td style="text-align: right;" class="header-info">
                <strong>N° {{ $cotizacion->id_cotizacion }}</strong><br>
                Calle Miguel Hidalgo 847, Col. La Providencia, Metepec, Edo. de México<br>
                Tel: 722 706 0685 | 720 829 3653<br>
                Email: ferreteriarodcas@gmail.com<br>
                Facturas: ferreteriarodcasfacturas@gmail.com
            </td>
        </tr>
    </table>
   

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cotizacion->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->producto ?? 'N/A' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio_unitario,2) }}</td>
                    <td>${{ number_format($detalle->cantidad * $detalle->precio_unitario,2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total"><strong>Total:</strong> ${{ number_format($cotizacion->total) }}</p>
</body>
</html>
