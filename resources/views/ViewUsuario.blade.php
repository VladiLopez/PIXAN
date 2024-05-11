<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Usuario</title>
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
        <a href="{{ route('detallesproductos.create') }}">REGISTRAR PRODUCTOS</a>}
        <a href="/detallesproductos">MIS PRODUCTOS</a>
    </div>
    <div class="container">
        <h1 class="text-center">Detalles del Usuario</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @foreach(explode(',', $usuario->profile_photo_path) as $imagen)
                            <div style="width: 220px;">
                                <img class="img-thumbnail" src="{{ asset('storage/' . $imagen) }}" alt="Foto de Perfil">   
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <p><strong>ID:</strong> {{ $usuario->id }}</p>
                        <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
                        <p><strong>Correo:</strong> {{ $usuario->email }}</p>
                        <p><strong>Administrador:</strong> 
                            @if($usuario->is_admin == 0)
                                Sí
                            @else
                                No
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
</body>
</html>
