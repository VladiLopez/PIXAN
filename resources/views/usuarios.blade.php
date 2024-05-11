<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluye jQuery -->
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesMostrar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="{{ route('pedidos.listar') }}">PEDIDOS</a>
        <a href="{{ route('detallesproductos.create') }}">REGISTRAR PRODUCTOS</a>
        <a href="/detallesproductos">MIS PRODUCTOS</a>
        <a href="{{ route('stockmateriales.create') }}">REGISTRAR MATERIALES</a>
        <a href="{{ route('stockmateriales.index') }}">MIS MATERIALES</a>
    </div>
    <div class="container mt-1">
        <h1 class="section-heading text-uppercase text-center">Usuarios</h1>
            <table class="table table-striped align-middle">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Administrador</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                @if($usuario->is_admin == 0)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$usuario->id}}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>    
                        </tr>
                        <!-- Modal de confirmación para eliminar -->
                        <div class="modal fade" id="exampleModal{{$usuario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar a este usuario? 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <!-- Agrega un identificador único al botón "Sí" en el modal de confirmación -->
                                    <button type="button" class="btn btn-primary" id="confirmDelete{{$usuario->id}}">Sí</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Genera el script para confirmar la eliminación -->
                            <script>
                                // Captura el evento de clic en el botón "Sí"
                                document.getElementById('confirmDelete{{$usuario->id}}').addEventListener('click', function() {
                                    // Realiza una solicitud HTTP al servidor utilizando JavaScript
                                    fetch('{{ route("usuarios.destroy", $usuario->id) }}', {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Agrega el token CSRF para protección
                                        },
                                    })
                                    .then(response => {
                                        if (response.ok) {
                                            // Cierra el modal después de confirmar la eliminación
                                            $('#exampleModal{{$usuario->id}}').modal('hide');
                                            // Redirige a la página de inicio o a donde desees después de eliminar el elemento
                                            window.location.href = '/usuarios';
                                        } else {
                                            // Maneja errores si la solicitud no fue exitosa
                                            console.error('Error al eliminar el elemento');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error al eliminar el elemento:', error);
                                    });
                                });
                            </script>
                    @endforeach
                </tbody>
            </table>
    </div>
</body>
</html>