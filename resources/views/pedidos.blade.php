<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
    @include('botones')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="mb-0">Detalles del Pedido</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5>Número de Pedido:</h5>
                        <p>{{ $pedido->id }}</p>
                        <h5>Fecha:</h5>
                        <p>{{ $pedido->fecha }}</p>
                        <h5>Cliente:</h5>
                        <p>{{ $pedido->user->name }}</p>
                    </div>
                    <div class="col-lg-6">
                        <h5>Productos:</h5>
                        <ul class="list-group">
                            @foreach($pedido->productos as $producto)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-lg-6">{{ $producto->nombre }}</div>
                                        <div class="col-lg-3">Cantidad: {{ $producto->pivot->cantidad }}</div>
                                        <div class="col-lg-3">Precio Unitario: ${{ $producto->pivot->precio_unitario }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
