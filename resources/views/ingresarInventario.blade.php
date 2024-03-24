<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Inventario</title>
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="/detallesinventario">MI INVENTARIO</a>
    </div>
    <div class="container mt-1">
    <h1 class="section-heading text-uppercase text-center">Ingresar Nuevo Producto</h1>
    <form action="{{ route('detallesinventario.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <label for="nombre" class="form-label">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}">

        <label for="cantidad" class="form-label">Cantidad:</label><br>
        <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{ old('cantidad') }}">

        <div class="form-floating">
            <textarea id="clasificacion" class="form-control" style="height: 100px;" name="clasificacion" placeholder="Clasificación: ">{{ old('clasificacion') }}</textarea>
            <label for="clasificacion">Clasificación:</label>
        </div>

        <div class="form-floating">
            <textarea id="descripcion" class="form-control" style="height: 100px;" name="descripcion" placeholder="Describa el producto: ">{{ old('descripcion') }}</textarea>
            <label for="descripcion" >Descripción:</label>
        </div>

        <label for="imagen" class="form-label">Imágen:</label><br>
        <input type="file" id="imagen" class="form-control" name="imagen" accept="image/*">
        @error('imagen')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <br>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    </div>
</body>
</html>