<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluye jQuery -->
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="{{ route('catalogo.productos') }}">CATÁLOGO</a>
    </div>
    <div class="container">
        <h1 class="my-4">Carrito de Compras</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Productos en el Carrito
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($productosEnCarrito as $producto)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>{{ $producto->producto->nombre }}</h5>
                                    <p>Cantidad: {{ $producto->cantidad }}</p>
                                    <p>Precio unitario: ${{ $producto->producto->precio }}</p>
                                    <span class="badge badge-primary badge-pill">${{ $producto->cantidad * $producto->producto->precio }}</span>
                                </div>
                                <form action="{{ route('carrito.eliminar', $producto->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total de la compra:
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${{ $total }}</h5>
                        <form id="realizar-pedido-form" action="{{ route('pedido.realizar') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <button id="realizar-pedido-btn" class="btn btn-primary">Realizar Pedido</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
