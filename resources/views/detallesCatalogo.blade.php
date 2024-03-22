<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <!-- Agrega aquí tus enlaces a CSS y JavaScript si es necesario -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluye jQuery -->
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesDetallesCatalogo.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
    </div>
    <div class="container">
        <h1 class="text-center">Detalles del Producto</h1>
        <div class="card">
            <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach(explode(',', $producto->imagenes) as $key => $imagen)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $imagen) }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                        <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                        <p><strong>Detalles:</strong> {{ $producto->caracteristicas }}</p>
                        <p><strong>Colores:</strong>
                        @foreach(json_decode($producto->colores) as $color)
                            <span class="color-circle" style="background-color: {{ $color }};"></span>
                        @endforeach
                        </p>
                        <p><strong>Precio:</strong> ${{ $producto->precio }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('catalogo.productos') }}" class="btn btn-primary">Volver al Catálogo</a>
            </div>
        </div>
    </div>
</body>
</html>
