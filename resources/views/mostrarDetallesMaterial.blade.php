<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Materiales</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="{{ route('stockmateriales.create') }}">REGISTRAR MATERIALES</a>
        <a href="{{ route('stockmateriales.index') }}">MIS MATERIALES</a>
        <a href="{{ route('detallesproductos.create') }}">REGISTRAR PRODUCTOS</a>
        <a href="{{ route('detallesproductos.index') }}">MIS PRODUCTOS</a>
        <a href="{{ route('usuarios.index') }}">USUARIOS</a></li>
    </div>
    <div class="container">
        <h1 class="text-center">DETALLES DEL MATERIAL</h1>
        <table  class="table table-striped align-middle">
            <tr>
                <th>Campo</th>
                <th>Valor</th>
            </tr>
            <tr>
                <td><strong>Nombre:</strong></td>
                <td>{{ $stockMateriales->nombre }}</td>
            </tr>
            <tr>
                <td><strong>Características:</strong></td>
                <td>{{ $stockMateriales->caracteristicas }}</td>
            </tr>
            <tr>
                <td><strong>Marca:</strong></td>
                <td>{{ $stockMateriales->marca }}</td>
            </tr>
            <tr>
                <td><strong>Colores:</strong></td>
                <td>
                    @foreach(json_decode($stockMateriales->colores) as $color)
                        <span class="color-circle" style="background-color: {{ $color }};"></span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><strong>Imágen:</strong></td>
                <td>
                    @foreach(explode(',', $stockMateriales->imagen) as $image)
                        <div style="width: 100px;">
                            <img class="img-thumbnail" src="{{ asset('storage/' . $image) }}" alt="Imagen del material">   
                        </div>
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
