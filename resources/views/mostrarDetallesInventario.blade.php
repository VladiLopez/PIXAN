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
        <a href="{{ route('detallesproductos.index') }}">MI INVENTARIO</a>
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
                <td>{{ $detalleInventario->nombre }}</td>
            </tr>
            <tr>
                <td><strong>Cantidad:</strong></td>
                <td>{{ $detalleInventario->cantidad }}</td>
            </tr>
            <tr>
                <td><strong>Clasificación:</strong></td>
                <td>{{ $detalleInventario->clasificacion }}</td>
            </tr>
            <tr>
                <td><strong>Descripción:</strong></td>
                <td>{{ $detalleProducto->descripcion }}</td>
            </tr>
            <tr>
                <td><strong>Imágen:</strong></td>
                <td>
                    @foreach(explode(',', $detalleProducto->imagenes) as $imagen)
                        <div style="width: 100px;">
                            <img class="img-thumbnail" src="{{ asset('storage/' . $imagen) }}" alt="Imagen del Producto">   
                        </div>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
</body>
</html>