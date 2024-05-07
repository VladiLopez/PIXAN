<!-- detalles-pedido.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluye jQuery -->
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
</head>
<body>
    <div class="container">
        <h1>Detalles del Pedido</h1>
        <p>Número de Pedido: {{ $numeroPedido }}</p>
        <h2>Productos Pedidos:</h2>
        <ul>
            @foreach ($productos as $producto)
                <li>
                    {{ $producto['nombre'] }} - Cantidad: {{ $producto['cantidad'] }}
                </li>
            @endforeach
        </ul>
        <p>Total de la Compra: ${{ $totalCompra }}</p>
    </div>
</body>
</html>
