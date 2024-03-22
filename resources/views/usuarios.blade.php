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
        <a href="{{ route('detallesproductos.create') }}">REGISTRAR PRODUCTOS</a>
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

                                    <a type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>    
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</body>
</html>
