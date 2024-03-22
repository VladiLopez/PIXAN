<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="{{ route('detallesproductos.create') }}">REGISTRAR PRODUCTOS</a>
        <a href="{{ route('detallesproductos.index') }}">MIS PRODUCTOS</a>
    </div>
    <div class="container">
        <h1 class="text-center">DETALLES DEL PRODUCTO</h1>
        <table  class="table table-striped align-middle">
            <tr>
                <th>Campo</th>
                <th>Valor</th>
            </tr>
            <tr>
                <td><strong>Nombre:</strong></td>
                <td>{{ $detalleProducto->nombre }}</td>
            </tr>
            <tr> 
                <td><strong>Precio:</strong></td>
                <td>$ {{ $detalleProducto->precio }}</td>
            </tr>
            <tr>
                <td><strong>Descripción:</strong></td>
                <td>{{ $detalleProducto->descripcion }}</td>
            </tr>
            <tr>
                <td><strong>Características:</strong></td>
                <td>{{ $detalleProducto->caracteristicas }}</td>
            </tr>
            <tr>
                <td><strong>Colores:</strong></td>
                <td>
                    @foreach(json_decode($detalleProducto->colores) as $color)
                        <span class="color-circle" style="background-color: {{ $color }};"></span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><strong>Imágenes:</strong></td>
                <td>
                    @foreach(explode(',', $detalleProducto->imagenes) as $imagen)
                        <div style="width: 100px;">
                            <img class="img-thumbnail" src="{{ asset('storage/' . $imagen) }}" alt="Imagen del Producto">   
                        </div>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><strong>Tiempo de Entrega:</strong></td>
                <td>{{ $detalleProducto->tiempo_entrega }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
