<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pedidos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="{{ route('detallesproductos.create') }}">REGISTRAR PRODUCTOS</a>
        <a href="/detallesproductos">MIS PRODUCTOS</a>
        <a href="/stockmateriales">MIS MATERIALES</a>
        <a href="{{ route('usuarios.index') }}">USUARIOS</a></li>
    </div>
    <div class="container">
        <h1 class="section-heading text-uppercase text-center">Listado de Pedidos</h1>
        <table class="table table-striped align-middle">
            <thead>
                <tr class="table-primary">
                    <th>Número de Pedido</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Detalles</th> <!-- Nuevo encabezado para el botón -->
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->fecha }}</td>
                    <td>{{ $pedido->user->name }}</td>
                    <td>
                        <a href="{{ route('pedidos.show', ['pedido' => $pedido->id]) }}" class="btn btn-primary">Ver Detalles</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
