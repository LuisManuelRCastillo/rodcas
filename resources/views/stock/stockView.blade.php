<x-app-layout>
    <div class="container">
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }

            :root {
                --primary-color: #dc6336;
                --dark-color: #333;
                --light-color: #fff;
                --bg-gray: #f4f4f4;
            }

        

            nav img {
                height: 60px;
            }

            .nav-links {
                display: flex;
                gap: 20px;
                flex-wrap: wrap;
            }

            .nav-links a {
                color: var(--dark-color);
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s;
            }

            .nav-links a:hover { color: var(--primary-color); }

            /* Menú hamburguesa */
            .menu-icon {
                display: none;
                font-size: 1.8rem;
                cursor: pointer;
            }

            #menu-toggle {
                display: none;
            }

            #menu-toggle:checked + .nav-links {
                display: flex;
                flex-direction: column;
                width: 100%;
                margin-top: 10px;
            }

            /* Tarjetas */
            .card img {
    width: 100%;        /* Se adapta al ancho de la tarjeta */
    height: auto;       /* Mantiene la proporción */
    max-height: 200px;  /* Máximo alto en desktop */
    object-fit: cover;  /* Cubre el área sin deformarse */
    border-radius: 0.5rem 0.5rem 0 0; /* Opcional, para las esquinas */
}

            /* Botón WhatsApp */
            .whatsapp-button {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #25d366;
                color: #fff;
                font-size: 28px;
                width: 55px;
                height: 55px;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 4px 6px rgba(0,0,0,0.3);
                z-index: 1000;
                transition: transform 0.3s ease;
            }
            .whatsapp-button:hover {
                transform: scale(1.1);
                background-color: #20b955;
            }

            /* Responsive */
            @media (max-width: 768px) {
                nav {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .menu-icon {
                    display: block;
                    position: absolute;
                    top: 18px;
                    right: 20px;
                }

                .nav-links {
                    display: none;
                    flex-direction: column;
                    width: 100%;
                    gap: 10px;
                }

                .nav-links a {
                    padding: 10px 0;
                    width: 100%;
                    text-align: center;
                }

                @media (max-width: 768px) {
                .card img {
                    scale:60%;
    
                }
            }
            }
        </style>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


       

       <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Inventario de Productos</h1>
    
    <div class="overflow-x-auto">
        <table  id="productosTable" class="min-w-full bg-white border rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Imagen</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Producto</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Precio Venta</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Precio Mayoreo</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Departamento</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr class="border-b hover:bg-gray-50 ">
                        <td class="px-6 py-4">
                            <img 
                                src="/assets/img/Subtítulo.png" 
                                alt="{{ $producto->producto }}" 
                                class="w-16 h-16 object-cover rounded"
                            >
                        </td>
                        <td class="px-6 py-4 text-gray-800 font-medium">{{ $producto->producto }}</td>
                        <td class="px-6 py-4 text-gray-700">${{ number_format($producto->p_venta, 2) }}</td>
                        <td class="px-6 py-4 text-gray-700">${{ number_format($producto->p_mayoreo, 2) }}</td>
                         <td class="px-6 py-4 text-gray-700">{{ $producto->dpto }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $producto->existencia }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#productosTable').DataTable({
        "paging": true,           // Desactivar paginación
        "searching": true,         // Buscador
        "ordering": true,          // Ordenamiento
        "order": [[1, "asc"]],     // Orden inicial por columna 1
        "language": {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ productos",
            "infoEmpty": "Mostrando 0 a 0 de 0 productos",
            "infoFiltered": "(filtrado de _MAX_ productos totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ productos",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron productos coincidentes",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar ascendente",
                "sortDescending": ": activar para ordenar descendente"
            }
        },
        "dom": '<"flex justify-between mb-2"<"text-sm font-medium"l><"text-sm font-medium"f>>rtip', // Tailwind styling
    });
});
</script>


       
    </div>
</x-app-layout>
