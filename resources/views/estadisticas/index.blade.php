@extends('layouts.layout')

@section('content')
    <h1>Panel de Estadísticas</h1>

    <div>
        <p><strong>Total de Ventas:</strong> {{ $totalVentas }}</p>
        <p><strong>Total de Ingresos:</strong> ${{ number_format($totalIngresos, 2) }}</p>

        @if ($productoMasVendido)
            <p><strong>Producto Más Vendido:</strong> {{ $productoMasVendido->producto->nombre }} ({{ $productoMasVendido->total_vendido }} unidades)</p>
        @else
            <p>No hay productos vendidos aún.</p>
        @endif

        @if ($clienteTop)
            <p><strong>Mejor Cliente:</strong> {{ $clienteTop->cliente->nombre }} (${{ number_format($clienteTop->total_comprado, 2) }})</p>
        @else
            <p>No hay ventas registradas aún.</p>
        @endif
    </div>

    <hr>

    <h3>Gráfica: Productos Más Vendidos</h3>
    <canvas id="productosMasVendidos" width="400" height="200"></canvas>

    <h3 class="mt-4">Gráfica: Ventas por Mes</h3>
    <canvas id="ventasPorMes" width="400" height="200"></canvas>

@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Gráfica de Productos Más Vendidos
        var ctxProductosMasVendidos = document.getElementById('productosMasVendidos').getContext('2d');
        var productosMasVendidos = new Chart(ctxProductosMasVendidos, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_column($ventasPorProducto, 'nombre')) !!},
                datasets: [{
                    label: 'Cantidad Vendida',
                    data: {!! json_encode(array_column($ventasPorProducto, 'ventas')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Gráfica de Ventas por Mes
        var ctxVentasPorMes = document.getElementById('ventasPorMes').getContext('2d');
        var ventasPorMes = new Chart(ctxVentasPorMes, {
            type: 'line',
            data: {
                labels: {!! json_encode($ventasPorMes->pluck('mes')) !!},
                datasets: [{
                    label: 'Total Vendido ($)',
                    data: {!! json_encode($ventasPorMes->pluck('total_mes')) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    </script>

    @section('scripts')
<script>
    // Gráfico de Productos Más Vendidos
    const ctxProductos = document.getElementById('productosMasVendidos').getContext('2d');
    new Chart(ctxProductos, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($ventasPorProducto, 'nombre')) !!},
            datasets: [{
                label: 'Cantidad Vendida',
                data: {!! json_encode(array_column($ventasPorProducto, 'ventas')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });

    // Gráfico de Ventas por Mes
    const ctxMeses = document.getElementById('ventasPorMes').getContext('2d');
    new Chart(ctxMeses, {
        type: 'line',
        data: {
            labels: {!! json_encode($ventasPorMes->pluck('mes')) !!},
            datasets: [{
                label: 'Ventas ($)',
                data: {!! json_encode($ventasPorMes->pluck('total_mes')) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.4)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        }
    });
</script>
@endsection


