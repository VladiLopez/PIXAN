<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="{{ route('verCarrito') }}"> 
            <img src="assets/img/carrito-de-compras.ico" alt="Carrito de compras" style="width: 32px; height: 32px;">
        </a>
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
                                    <a href="{{ route('detallesCatalogo.productos', $detalleProducto->id) }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i> Ver detalles</a>
                                    <button type="button" onclick="agregarAlCarrito(event, '{{ $detalleProducto->id }}')" class="btn btn-sm btn-primary"><i class="fas fa-cart-plus"></i></button>
                                    <form id="addToCartForm{{$detalleProducto->id}}" action="{{ route('agregarAlCarrito') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="producto_id" value="{{ $detalleProducto->id }}">
                                        <input type="hidden" name="cantidad" value="1">
                                    </form>
                                </div>
                                <small class="text-muted">${{ $detalleProducto->precio }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function agregarAlCarrito(event, productoId) {
            // Prevenir que el formulario se envíe de manera tradicional
            event.preventDefault();

            // Obtener el formulario correspondiente al producto
            var form = $('#addToCartForm' + productoId);

            // Enviar la solicitud AJAX
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Mostrar la alerta de éxito
                    showAlert('Producto agregado al carrito con éxito.');
                },
                error: function(xhr, status, error) {
                    // Manejar el error de manera apropiada (si es necesario)
                    console.error('Error al agregar el producto al carrito:', error);
                }
            });
        }

        function showAlert(message) {
            // Muestra una alerta con el mensaje dado
            alert(message);
        }
    </script>
</body>
</html>
