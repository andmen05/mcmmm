<h1>Ventas</h1>
<a href="{{ route('ventas.create') }}">Nueva venta</a>
<ul>
    @foreach($ventas as $venta)
        <li>
            Cliente: {{ $venta->cliente->nombre }} | Fecha: {{ $venta->created_at->format('d/m/Y') }} | Total: ${{ $venta->total }}
        </li>
    @endforeach
</ul>
