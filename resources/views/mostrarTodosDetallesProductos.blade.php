<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Todos los Detalles de Productos</title>
</head>
<body>
    <div>
        <a href="/">INICIO</a>
        <a href="{{ route('detallesproductos.create') }}">REGISTRAR PRODUCTOS</a>
    </div>
    <div>
        <h1>Mostrar Detalles de Productos</h1>
        @if ($detallesProductos->isEmpty())
            <p>No hay productos para mostrar.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Características</th>
                        <th scope="col">Colores</th>
                        <th scope="col">Imágenes</th>
                        <th scope="col">Tiempo de Entrega</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detallesProductos as $detalleProducto)
                    <tr>
                        <td>{{ $detalleProducto->nombre }}</td>
                        <td>$ {{ $detalleProducto->precio }}</td>
                        <td>{{ $detalleProducto->descripcion }}</td>
                        <td>{{ $detalleProducto->caracteristicas }}</td>
                        <td>
                            @foreach(json_decode($detalleProducto->colores) as $color)
                                {{ $color }},
                            @endforeach
                        </td>
                        <td>
                            @foreach(explode(',', $detalleProducto->imagenes) as $imagen)
                            <div>
                                <img src="{{ asset('storage/' . $imagen) }}" alt="Imagen del Producto">   
                            </div>
                            @endforeach
                        </td>
                        <td>{{ $detalleProducto->tiempo_entrega }}</td>
                        <td>
                            <div>
                                <a href="{{ route('detallesproductos.show', $detalleProducto->id) }}">Ver</a>

                                <a href="{{ route('detallesproductos.edit', $detalleProducto->id) }}">Editar</a>

                                <form action="{{ route('detallesproductos.destroy', $detalleProducto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            </div>
                        </td>
                        <!-- Aquí se agregan las celdas -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
