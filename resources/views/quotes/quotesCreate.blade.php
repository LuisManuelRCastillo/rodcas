<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nueva Cotización
        </h2>
    </x-slot>

    <style>
        :root { --brand: #dc6336; --brand-dark: #b84e27; }

        /* ---- Layout ---- */
        .cot-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 1.5rem;
            align-items: start;
        }
        @media(max-width:900px){ .cot-grid{ grid-template-columns:1fr; } }

        /* ---- Cards ---- */
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
            padding: 1.5rem;
        }
        .card-title {
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: .75rem;
        }

        /* ---- Inputs ---- */
        .field label { display:block; font-size:.85rem; font-weight:600; color:#374151; margin-bottom:.3rem; }
        .field select, .field input[type=text], .field input[type=number] {
            width:100%; padding:.55rem .75rem; border:1.5px solid #e5e7eb;
            border-radius:8px; font-size:.9rem; outline:none; transition:border-color .2s;
        }
        .field select:focus, .field input:focus { border-color:var(--brand); }

        /* ---- Search dropdown ---- */
        #resultados {
            position:absolute; top:calc(100% + 4px); left:0; right:0;
            background:#fff; border:1.5px solid #e5e7eb; border-radius:8px;
            max-height:220px; overflow-y:auto; z-index:50;
            box-shadow:0 8px 24px rgba(0,0,0,.12);
        }
        .res-item {
            display:flex; justify-content:space-between; align-items:center;
            padding:.6rem 1rem; cursor:pointer; font-size:.85rem; transition:background .15s;
        }
        .res-item:hover { background:#fef3ec; }
        .res-item .res-name { font-weight:600; color:#1f2937; }
        .res-item .res-price { color:var(--brand); font-weight:700; font-size:.8rem; }
        .res-item .res-stock { font-size:.72rem; color:#9ca3af; }

        /* ---- Artículo personalizado ---- */
        #panelPersonalizado {
            background:#fef9f6; border:1.5px dashed #f0a47a;
            border-radius:10px; padding:1rem; margin-top:.75rem;
        }
        #panelPersonalizado.hidden { display:none; }
        .personal-grid { display:grid; grid-template-columns:1fr 80px 110px auto; gap:.5rem; align-items:end; }
        @media(max-width:600px){ .personal-grid{ grid-template-columns:1fr 1fr; } }

        /* ---- Tabla de productos ---- */
        #tablaProductos { width:100%; border-collapse:separate; border-spacing:0; }
        #tablaProductos thead tr th {
            background:#f9fafb; font-size:.72rem; font-weight:700; letter-spacing:.06em;
            text-transform:uppercase; color:#6b7280; padding:.6rem .75rem;
            border-bottom:2px solid #e5e7eb; text-align:left;
        }
        #tablaProductos tbody tr { transition:background .15s; }
        #tablaProductos tbody tr:hover { background:#fef9f6; }
        #tablaProductos tbody td {
            padding:.55rem .75rem; border-bottom:1px solid #f3f4f6;
            font-size:.88rem; color:#374151; vertical-align:middle;
        }
        .badge-custom {
            font-size:.65rem; background:#fef3ec; color:var(--brand);
            border-radius:99px; padding:.1rem .45rem; font-weight:700;
            vertical-align:middle; margin-left:.4rem;
        }
        .qty-input { width:64px; text-align:center; padding:.35rem .4rem; border:1.5px solid #e5e7eb; border-radius:6px; font-size:.88rem; }
        .price-input { width:96px; padding:.35rem .5rem; border:1.5px solid #e5e7eb; border-radius:6px; font-size:.88rem; }
        .qty-input:focus,.price-input:focus { border-color:var(--brand); outline:none; }
        .btn-del { background:none; border:none; cursor:pointer; color:#ef4444; padding:.25rem; border-radius:6px; transition:background .15s; }
        .btn-del:hover { background:#fee2e2; }
        #emptyRow td { text-align:center; color:#9ca3af; padding:2rem; font-size:.88rem; }

        /* ---- Resumen ---- */
        .summary-row { display:flex; justify-content:space-between; font-size:.88rem; color:#374151; padding:.35rem 0; }
        .summary-row.total { font-size:1.1rem; font-weight:700; color:var(--brand); border-top:2px solid #e5e7eb; padding-top:.6rem; margin-top:.35rem; }

        /* ---- Botones ---- */
        .btn-brand {
            display:inline-flex; align-items:center; gap:.45rem;
            background:var(--brand); color:#fff; border:none; cursor:pointer;
            padding:.65rem 1.4rem; border-radius:9px; font-weight:700; font-size:.9rem;
            transition:background .2s, transform .1s;
        }
        .btn-brand:hover { background:var(--brand-dark); }
        .btn-brand:active { transform:scale(.97); }
        .btn-outline {
            display:inline-flex; align-items:center; gap:.4rem;
            background:#fff; color:var(--brand); border:1.5px solid var(--brand);
            cursor:pointer; padding:.55rem 1rem; border-radius:9px; font-weight:600; font-size:.85rem;
            transition:background .2s;
        }
        .btn-outline:hover { background:#fef3ec; }
        .btn-sm { padding:.35rem .7rem; font-size:.8rem; border-radius:7px; }
    </style>

    <div class="py-8 px-4 max-w-7xl mx-auto">

        {{-- Alertas --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-300 text-green-800 p-3 rounded-lg mb-4 text-sm">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 p-3 rounded-lg mb-4 text-sm">
                @foreach($errors->all() as $error)<div>• {{ $error }}</div>@endforeach
            </div>
        @endif

        <form action="{{ route('cotizaciones.store') }}" method="POST" id="formCotizacion">
        @csrf

        <div class="cot-grid">

            {{-- ══════ Columna izquierda ══════ --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;">

                {{-- Cliente --}}
                <div class="card">
                    <p class="card-title">Información del cliente</p>
                    <div class="field">
                        <label for="id_cliente">Cliente *</label>
                        <select name="id_cliente" id="id_cliente" required>
                            <option value="">— Selecciona un cliente —</option>
                            @foreach($clientes as $c)
                                <option value="{{ $c->id }}" {{ old('id_cliente') == $c->id ? 'selected' : '' }}>
                                    {{ $c->name  }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Buscador + artículo personalizado --}}
                <div class="card">
                    <p class="card-title">Agregar productos</p>

                    <div class="field" style="position:relative;">
                        <label>Buscar en inventario</label>
                        <div style="position:relative;">
                            <input type="text" id="buscarProducto" placeholder="Nombre o código del producto..." autocomplete="off">
                            <div id="resultados" style="display:none;"></div>
                        </div>
                    </div>

                    {{-- Separador --}}
                    <div style="display:flex;align-items:center;gap:.75rem;margin:.9rem 0;">
                        <hr style="flex:1;border-color:#e5e7eb;">
                        <span style="font-size:.75rem;color:#9ca3af;font-weight:600;">O AGREGA ARTÍCULO MANUAL</span>
                        <hr style="flex:1;border-color:#e5e7eb;">
                    </div>

                    <button type="button" id="togglePersonalizado" class="btn-outline btn-sm" style="margin-bottom:.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Artículo personalizado
                    </button>

                    <div id="panelPersonalizado" class="hidden">
                        <p style="font-size:.78rem;color:#92400e;margin-bottom:.7rem;">
                            Este artículo <strong>no se guardará</strong> en el inventario, solo aparecerá en el PDF.
                        </p>
                        <div class="personal-grid">
                            <div class="field" style="margin:0;">
                                <label style="font-size:.78rem;">Descripción *</label>
                                <input type="text" id="pNombre" placeholder="Ej: Tubo PVC 2 pulgadas" />
                            </div>
                            <div class="field" style="margin:0;">
                                <label style="font-size:.78rem;">Cantidad</label>
                                <input type="number" id="pCantidad" value="1" min="1" />
                            </div>
                            <div class="field" style="margin:0;">
                                <label style="font-size:.78rem;">Precio unit.</label>
                                <input type="number" id="pPrecio" step="0.01" min="0" placeholder="0.00" />
                            </div>
                            <div style="padding-bottom:.1rem;">
                                <button type="button" id="btnAgregarPersonalizado" class="btn-brand btn-sm">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabla de productos --}}
                <div class="card" style="overflow-x:auto;">
                    <p class="card-title">Detalle de la cotización</p>
                    <table id="tablaProductos">
                        <thead>
                            <tr>
                                <th style="width:45%;">Producto / Descripción</th>
                                <th style="width:12%;text-align:center;">Cant.</th>
                                <th style="width:18%;text-align:right;">Precio unit.</th>
                                <th style="width:18%;text-align:right;">Subtotal</th>
                                <th style="width:7%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="emptyRow">
                                <td colspan="5">
                                    <div style="display:flex;flex-direction:column;align-items:center;gap:.5rem;padding:1.5rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#d1d5db" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                                        </svg>
                                        Sin productos — busca en inventario o agrega un artículo manual
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- ══════ Columna derecha: Resumen ══════ --}}
            <div style="position:sticky;top:1.5rem;display:flex;flex-direction:column;gap:1.25rem;">

                <div class="card">
                    <p class="card-title">Resumen</p>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>$<span id="resTotal">0.00</span></span>
                    </div>
                    <p style="font-size:.72rem;color:#9ca3af;margin-top:.6rem;">* Precios en MXN con IVA incluido.</p>
                </div>

                <button type="submit" class="btn-brand" style="width:100%;justify-content:center;padding:.8rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                    Guardar y descargar PDF
                </button>

                <a href="{{ route('cotizaciones.index') }}" style="text-align:center;font-size:.83rem;color:#6b7280;text-decoration:none;">
                    ← Volver a cotizaciones
                </a>
            </div>

        </div>
        </form>
    </div>

    <script>
    (function () {
        let items   = [];   // [{uid, id_producto, descripcion, cantidad, precio_unitario, esPersonalizado}]
        let uidNext = 0;

        /* ─── Totales ─── */
        function recalcular() {
            let sub = items.reduce((s, i) => s + i.cantidad * i.precio_unitario, 0);
            document.getElementById('resTotal').textContent = sub.toFixed(2);
            document.getElementById('emptyRow').style.display  = items.length ? 'none' : '';
        }

        /* ─── Renderizar fila ─── */
        function renderFila(item) {
            const tbody = document.querySelector('#tablaProductos tbody');
            const tr    = document.createElement('tr');
            tr.setAttribute('data-uid', item.uid);

            const badgeHtml = item.esPersonalizado
                ? '<span class="badge-custom">manual</span>' : '';

            // Hidden inputs para el submit
            const idx = item.uid;
            tr.innerHTML = `
                <td>
                    <span style="font-weight:600;">${item.descripcion}</span>${badgeHtml}
                    <input type="hidden" name="detalles[${idx}][descripcion]"     value="${item.descripcion}">
                    <input type="hidden" name="detalles[${idx}][id_producto]"     value="${item.id_producto ?? ''}">
                </td>
                <td style="text-align:center;">
                    <input type="number" class="qty-input" name="detalles[${idx}][cantidad]"
                        value="${item.cantidad}" min="1" data-uid="${item.uid}">
                </td>
                <td style="text-align:right;">
                    <input type="number" class="price-input" name="detalles[${idx}][precio_unitario]"
                        step="0.01" value="${item.precio_unitario.toFixed(2)}" min="0" data-uid="${item.uid}">
                </td>
                <td style="text-align:right;font-weight:600;" class="cell-sub">
                    $${(item.cantidad * item.precio_unitario).toFixed(2)}
                </td>
                <td style="text-align:center;">
                    <button type="button" class="btn-del" data-uid="${item.uid}" title="Eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        }

        /* ─── Agregar item ─── */
        function agregarItem(item) {
            // Evitar duplicados de inventario
            if (item.id_producto && items.some(i => i.id_producto == item.id_producto)) {
                alert('Este producto ya está en la cotización.');
                return;
            }
            item.uid = uidNext++;
            items.push(item);
            renderFila(item);
            recalcular();
        }

        /* ─── Delegación de eventos en tabla ─── */
        document.querySelector('#tablaProductos tbody').addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-del');
            if (!btn) return;
            const uid = parseInt(btn.dataset.uid);
            items = items.filter(i => i.uid !== uid);
            btn.closest('tr').remove();
            recalcular();
        });

        document.querySelector('#tablaProductos tbody').addEventListener('input', function (e) {
            const uid  = parseInt(e.target.dataset.uid);
            const item = items.find(i => i.uid === uid);
            if (!item) return;
            const tr = e.target.closest('tr');
            if (e.target.classList.contains('qty-input'))   item.cantidad        = parseInt(e.target.value)   || 0;
            if (e.target.classList.contains('price-input')) item.precio_unitario = parseFloat(e.target.value) || 0;
            tr.querySelector('.cell-sub').textContent = '$' + (item.cantidad * item.precio_unitario).toFixed(2);
            recalcular();
        });

        /* ─── Búsqueda en inventario ─── */
        const inputBuscar    = document.getElementById('buscarProducto');
        const divResultados  = document.getElementById('resultados');
        let   debounceTimer;

        inputBuscar.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const q = this.value.trim();
            if (q.length < 2) { divResultados.style.display = 'none'; return; }
            debounceTimer = setTimeout(() => {
                fetch(`{{ route('productos.buscar') }}?q=${encodeURIComponent(q)}`)
                    .then(r => r.json())
                    .then(data => {
                        divResultados.innerHTML = '';
                        if (!data.length) {
                            divResultados.innerHTML = '<div class="res-item" style="color:#9ca3af;">Sin resultados</div>';
                        } else {
                            data.forEach(p => {
                                const div = document.createElement('div');
                                div.className = 'res-item';
                                div.innerHTML = `
                                    <div>
                                        <div class="res-name">${p.producto}</div>
                                        <div class="res-stock">Stock: ${p.existencia ?? '—'} | Cód: ${p.codigo ?? '—'}</div>
                                    </div>
                                    <div class="res-price">$${parseFloat(p.p_venta).toFixed(2)}</div>
                                `;
                                div.addEventListener('click', () => {
                                    agregarItem({
                                        id_producto:     p.id_producto,
                                        descripcion:     p.producto,
                                        cantidad:        1,
                                        precio_unitario: parseFloat(p.p_venta),
                                        esPersonalizado: false,
                                    });
                                    divResultados.style.display = 'none';
                                    inputBuscar.value = '';
                                });
                                divResultados.appendChild(div);
                            });
                        }
                        divResultados.style.display = 'block';
                    });
            }, 280);
        });

        document.addEventListener('click', e => {
            if (!inputBuscar.contains(e.target) && !divResultados.contains(e.target)) {
                divResultados.style.display = 'none';
            }
        });

        /* ─── Panel artículo personalizado ─── */
        document.getElementById('togglePersonalizado').addEventListener('click', () => {
            document.getElementById('panelPersonalizado').classList.toggle('hidden');
        });

        document.getElementById('btnAgregarPersonalizado').addEventListener('click', () => {
            const nombre   = document.getElementById('pNombre').value.trim();
            const cantidad = parseInt(document.getElementById('pCantidad').value) || 1;
            const precio   = parseFloat(document.getElementById('pPrecio').value)  || 0;
            if (!nombre) { alert('Ingresa una descripción para el artículo.'); return; }
            if (precio <= 0) { alert('Ingresa un precio válido.'); return; }
            agregarItem({ id_producto: null, descripcion: nombre, cantidad, precio_unitario: precio, esPersonalizado: true });
            document.getElementById('pNombre').value    = '';
            document.getElementById('pCantidad').value  = '1';
            document.getElementById('pPrecio').value    = '';
        });

        /* ─── Validación antes de submit ─── */
        document.getElementById('formCotizacion').addEventListener('submit', function (e) {
            if (items.length === 0) {
                e.preventDefault();
                alert('Agrega al menos un producto a la cotización.');
            }
        });

        recalcular();
    })();
    </script>
</x-app-layout>
