<x-app-layout>
    <x-slot name="header">
        <style>
        body {
            background-color: lightgray;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .header-navbar {
            background-color: #0098a7;
            width: 100%;
            z-index: 10;
        }
        
        .contenedor-cruds {
            display: flex;
            flex-grow: 1;
            height: calc(100vh - 56px); /* Adjust based on header height */
            overflow: hidden;
        }
        
        .bar-cruds {
            width: 220px;
            background-color: #6c757d;
            overflow-y: auto;
        }
        
        .content-area {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }
        
        .div-logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logoPrincipal {
            height: 100px;
            width: 100px;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .div-login,
        .div-menu {
            margin-right: 2%;
            margin-left: 2%;
        }
        
        .iniciosesion,
        .menu {
            background-color: #a1bf34;
            color: white;
        }
        
        .div-footer {
            background-color: #0098a7;
            width: 100%;
            position: relative;
            z-index: 10;
            margin-top: auto;
            padding: 10px;
            text-align: center;
        }
    </style>
     
    </x-slot>

<body>
 <div class="d-flex flex-grow-1">
        <nav class="bar-cruds text-light p-3">
            <ul class="nav flex-column">
                <!-- Otras secciones -->
                <li class="nav-item mb-2">
                    <a href="{{ url('/createAuthor') }}" class="nav-link text-light d-flex align-items-center">
                        <i class="bi bi-hospital"></i>
                        Crear Autores 
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ url('/createLibro') }}" class="nav-link text-light d-flex align-items-center">
                        <i class="bi bi-hospital"></i>
                        Crear Libro 
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ url('/createCategory') }}" class="nav-link text-light d-flex align-items-center">
                        <i class="bi bi-hospital"></i>
                        Crear Categoria
                    </a>
                </li>
            </ul>
        </nav>
        <div class="flex-grow-1 p-3">
            <div class="content-area" id="content-area">
                <!-- Aquí se cargará el contenido dinámico -->
                @yield('createAuthor')
                @yield('createLibro')
                @yield('createCategory')
            </div>
        </div>
    </div>
</x-app-layout>

