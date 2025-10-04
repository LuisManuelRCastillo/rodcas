<x-guest-layout>
    <div class="container">
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }

            :root {
                --primary-color: #dc6336;
                --dark-color: #333;
                --light-color: #fff;
                --bg-gray: #f4f4f4;
            }

            body {
                font-family: 'Poppins', sans-serif;
                background-color: var(--bg-gray);
                color: var(--dark-color);
                line-height: 1.6;
            }

            nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background: #F2F2F2;
                padding: 15px 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                position: relative;
                flex-wrap: wrap;
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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <nav class="container">
            <img src="assets/img/logoRC.png" alt="Logo Ferretería RODCAS" />
            <label for="menu-toggle" class="menu-icon">
                <i class="fas fa-bars"></i>
            </label>
            <input type="checkbox" id="menu-toggle">
            <div class="nav-links">
                <a href="#">Inicio</a>
                <a href="#">Catálogo</a>
                <a href="#">Cotizaciones</a>
                <a href="#">Colaboradores</a>
                <a href="{{ route('login') }}">Iniciar</a>
            </div>
        </nav>

        <div class="container mx-auto p-4">
            <h1 class="text-3xl font-bold mb-6 text-center">Catálogo de Productos</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($productos as $producto)
                    <div class="bg-white border rounded-lg shadow hover:shadow-lg transition-shadow duration-300 card">
                        <img 
                            src="/assets/img/Subtítulo.png" 
                            alt="{{ $producto->producto }}" 
                            class="w-full rounded-t-lg"
                        >
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $producto->producto }}</h2>
                            <p class="text-gray-700 mb-1">Precio Venta: <span class="font-bold">${{ number_format($producto->p_venta, 2) }}</span></p>
                            <p class="text-gray-700 mb-1">Precio Mayoreo: <span class="font-bold">${{ number_format($producto->p_mayoreo, 2) }}</span></p>
                            <p class="text-gray-500 text-sm">Stock: {{ $producto->existencia }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- BOTÓN WHATSAPP -->
        <a href="https://wa.me/527208293653?text=Hola%20quiero%20más%20información" 
           class="whatsapp-button" target="_blank">
           <i class="fab fa-whatsapp"></i>
        </a>
    </div>
</x-guest-layout>
