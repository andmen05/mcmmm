<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MCMMM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            padding: 30px;
        }
        .container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: auto;
        }
        h1 {
            color: #333;
        }
        a.button {
            text-decoration: none;
            background: #3490dc;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 15px;
        }
        input, select {
            width: 100%;
            margin: 10px 0;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 15px;
            background: #38c172;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .navbar {
            background-color: #343a40;
            padding: 10px 25px;
            margin-bottom: 30px;
            border-radius: 10px;
        }
        .navbar a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 15px;
        }
        .navbar a:hover {
            color: #ffc107;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <div class="navbar">
        <a href="{{ url('/productos') }}">Productos</a>
        <a href="{{ url('/ventas') }}">Ventas</a>
        <a href="{{ url('/clientes') }}">Clientes</a>
        <a href="{{ url('/categorias') }}">Categorías</a>
        <a href="{{ url('/estadisticas') }}">Estadísticas</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">Cerrar sesión</button>
        </form>
    </div>

    <div class="container">
        @yield('content')
    </div>

    {{-- Scripts comunes --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    {{-- Scripts de cada vista --}}
    @yield('scripts')
</body>
</html>
