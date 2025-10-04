<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Cotización') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('cotizaciones.store') }}" method="POST" id="formCotizacion">
                    @csrf

                    <!-- Cliente -->
                    <div class="mb-4">
                        <label for="id_cliente" class="block font-medium text-gray-700">Cliente</label>
                        <select name="id_cliente" id="id_cliente" class="form-select mt-1 block w-full border-gray-300 rounded">
                            <option value="">-- Selecciona un cliente --</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Buscador de productos -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Buscar Productos</label>
                        <input type="text" id="buscarProducto" class="w-full border-gray-300 rounded p-2" placeholder="Escribe el nombre del producto...">
                        <div id="resultados" class="border border-gray-300 mt-2 max-h-48 overflow-y-auto hidden"></div>
                    </div>

                    <!-- Productos agregados -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700">Productos seleccionados</label>
                        <table class="w-full table-auto border border-gray-300" id="tablaProductos">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-2 py-1 border">Producto</th>
                                    <th class="px-2 py-1 border">Cantidad</th>
                                    <th class="px-2 py-1 border">Precio Unitario</th>
                                    <th class="px-2 py-1 border">Total</th>
                                    <th class="px-2 py-1 border">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas se agregarán dinámicamente -->
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-between mt-4">
                        <div class="font-bold text-lg">Total: $<span id="total">0.00</span></div>
                        <button type="submit" class="px-4 py-2 text-white rounded hover:bg-white" style="background: #dc6336; ">
                            Guardar Cotización
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        let productos = [];
        let contador = 0;

        const actualizarTotal = () => {
            let total = 0;
            productos.forEach(p => {
                total += p.cantidad * p.precio_unitario;
            });
            document.getElementById('total').textContent = total.toFixed(2);
        }

        const agregarFila = (producto) => {
            // Evitar duplicados
            if(productos.some(p => p.id_producto === producto.id_producto)) return;

            productos.push({
                ...producto,
                cantidad: 1,
                precio_unitario: producto.p_venta
            });

            const tbody = document.querySelector('#tablaProductos tbody');
            const fila = document.createElement('tr');
            fila.setAttribute('data-id', producto.id_producto);
            fila.innerHTML = `
                <td class="border px-2 py-1">${producto.producto}</td>
                <td class="border px-2 py-1">
                    <input type="number" name="detalles[${contador}][cantidad]" value="1" min="1" class="cantidad w-16 border-gray-300 rounded" />
                    <input type="hidden" name="detalles[${contador}][id_producto]" value="${producto.id_producto}" />
                </td>
                 <td class="border px-2 py-1">
            <input type="number" step="0.01" name="detalles[${contador}][precio_unitario]" value="${producto.p_venta}" class="precio w-24 border-gray-300 rounded" />
        </td>
                <td class="border px-2 py-1 subtotal">${producto.p_venta.toFixed(2)}</td>
                <td class="border px-2 py-1">
                    <button type="button" class="text-red-600 eliminar">Eliminar</button>
                </td>
            `;
            tbody.appendChild(fila);
            contador++;
            actualizarTotal();
        }

        // Buscar productos
        document.getElementById('buscarProducto').addEventListener('input', function() {
            const query = this.value;
            if(query.length < 2){
                document.getElementById('resultados').innerHTML = '';
                document.getElementById('resultados').classList.add('hidden');
                return;
            }

            fetch(`{{ route('productos.buscar') }}?q=${query}`)
                .then(res => res.json())
                .then(data => {
                    const resultadosDiv = document.getElementById('resultados');
                    resultadosDiv.innerHTML = '';
                    if(data.length === 0){
                        resultadosDiv.innerHTML = '<div class="p-2">No se encontraron productos</div>';
                    } else {
                        data.forEach(p => {
                            const div = document.createElement('div');
                            div.classList.add('p-2', 'hover:bg-gray-200', 'cursor-pointer');
                            div.textContent = `${p.producto} ($${p.p_venta})`;
                            div.addEventListener('click', () => {
                                agregarFila(p);
                                resultadosDiv.innerHTML = '';
                                resultadosDiv.classList.add('hidden');
                                document.getElementById('buscarProducto').value = '';
                            });
                            resultadosDiv.appendChild(div);
                        });
                    }
                    resultadosDiv.classList.remove('hidden');
                });
        });

        // Eliminar producto
        document.querySelector('#tablaProductos tbody').addEventListener('click', function(e){
    if(e.target.classList.contains('eliminar')){
        const tr = e.target.closest('tr');
        const id = parseInt(tr.getAttribute('data-id'));

        // Quitar del array productos
        productos = productos.filter(p => p.id_producto !== id);

        // Quitar la fila de la tabla
        tr.remove();

        // Recalcular total
        actualizarTotal();
    }
        });

        // Actualizar subtotal al cambiar cantidad
        document.querySelector('#tablaProductos tbody').addEventListener('input', function(e){
               const tr = e.target.closest('tr');
    const id = parseInt(tr.getAttribute('data-id'));
    const producto = productos.find(p => p.id_producto === id);

    if(!producto) return;

    if(e.target.classList.contains('cantidad')){
        producto.cantidad = parseInt(e.target.value) || 0;
    }
    if(e.target.classList.contains('precio')){
        producto.precio_unitario = parseFloat(e.target.value) || 0;
    }

    // Actualizar subtotal de la fila
    const subtotal = producto.cantidad * producto.precio_unitario;
    tr.querySelector('.subtotal').textContent = subtotal.toFixed(2);

    // Actualizar total general
    actualizarTotal();
        });
    </script>
</x-app-layout>
