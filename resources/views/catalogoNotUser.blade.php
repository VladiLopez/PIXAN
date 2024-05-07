<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos </title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluye jQuery -->
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesCatalogo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
    </div>
    <div class="container">
        <h1 class="text-center">Catálogo de Productos</h1>
        <div class="row">
            <!-- Iteración sobre los productos -->
            @foreach($detallesProductos as $detalleProducto)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="{{ asset('storage/' . explode(',', $detalleProducto->imagenes)[0]) }}" alt="Producto">
                        <div class="card-body">
                            <h5 class="card-title">{{ $detalleProducto->nombre }}</h5>
                            <p class="card-text">{{ $detalleProducto->descripcion }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ route('detallesCatalogo.productos', $detalleProducto->id) }}" class="btn btn-sm btn-outline-secondary">Ver detalles</a>
                                </div>
                                <small class="text-muted">${{ $detalleProducto->precio }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>