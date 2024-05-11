<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirmacionPedido.css') }}">
</head>
<body>
    <div class="container">
        <h1>Detalles del Pedido</h1>
        <p class="pedido-number">Número de Pedido: {{ $ultimoPedido->id }}</p>
        <div class="productos-pedidos">
            @foreach ($productosPedido as $pedidoProducto)
            <div class="producto-item">
                <div class="producto-nombre">{{ $pedidoProducto->producto->nombre }}</div>
                <div class="producto-info">
                    <span>Cantidad: {{ $pedidoProducto->cantidad }}</span>
                    <span class="producto-precio">${{ $pedidoProducto->producto->precio }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <p class="total-compra">Total de la Compra: ${{ $totalCompra }}</p>
        <a href="{{ route('catalogo.productos') }}" class="btn btn-primary btn-lg btn-confirmar">Regresar a catalogo <i class="fas fa-arrow-right"></i></a>
    </div>
</body>
</html>