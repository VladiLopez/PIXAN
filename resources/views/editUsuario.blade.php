<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
<div class="botones-container">
        <a href="/">INICIO</a>
        <a href="{{ route('detallesproductos.create') }}">REGISTRAR PRODUCTOS</a>
        <a href="/detallesproductos">MIS PRODUCTOS</a>
</div>
<div class="container mt-1">
    <h1 class="text-center">Editar Usuario</h1>
    <div class="card">
        <div class="card-body">
            <form id="editarUsuarioForm" method="POST" action="{{ route('usuarios.update', $usuario->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->name }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}">
                </div>
                <div class="mb-3">
                    <label for="is_admin" class="form-label">Administrador</label>
                    <select class="form-select" id="is_admin" name="is_admin">
                        <option value="0" {{ $usuario->is_admin == 0 ? 'selected' : '' }}>Sí</option>
                        <option value="1" {{ $usuario->is_admin == 1 ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="mb-3">
                    @foreach(explode(',', $usuario->profile_photo_path) as $imagen)
                    <div style="width: 100px;">
                        <img class="img-thumbnail" src="{{ asset('storage/' . $imagen) }}" alt="Imagen del Producto">   
                    </div>
                    @endforeach
                    <label for="profile_photo_path" class="form-label">Foto de Perfil</label>
                    <input type="file" class="form-control" id="profile_photo_path" name="profile_photo_path[]">
                </div>
        </div>
        <div class="card-footer">
            <button type="submit" form="editarUsuarioForm" class="btn btn-primary">Guardar Cambios</button>
            </form>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</div>
</body>
</html>