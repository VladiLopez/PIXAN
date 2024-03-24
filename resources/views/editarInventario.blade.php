<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inventario</title>
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="/detallesproductos">MI INVENTARIO</a>
    </div>
    <div class="container mt-1">
    <h1 class="section-heading text-uppercase text-center">Editar Producto</h1>
    <form action="{{ route('detallesinventario.update', $detalleInventario->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="nombre" class="form-label">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $detalleInventario->nombre }}">

        <label for="cantidad" class="form-label">Cantidad:</label><br>
        <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{ $detalleInventario->cantidad }}">

        <div class="form-floating">
            <textarea id="clasificacion" class="form-control" style="height: 100px;" name="clasificacion" placeholder="Clasificación: ">{{ $detalleProducto->clasificacion }}</textarea>
            <label for="clasificacion">Clasificación:</label>
        </div>

        <div class="form-floating">
            <textarea id="descripcion" class="form-control" style="height: 100px;" name="descripcion" placeholder="Describa el producto :p">{{ $detalleProducto->descripcion }}</textarea>
            <label for="descripcion">Descripción:</label>
        </div>

        <label for="imagen" class="form-label">Imágen:</label><br>
        <!-- Aquí puedes mostrar las imágenes actuales del producto -->
        <!-- @foreach(explode(',', $detalleProducto->imagenes) as $imagen)--> 
        <div style="width: 100px;">
            <img class="img-thumbnail" src="{{ asset('storage/' . $imagen) }}" alt="Imagen del Producto">   
        </div>
       <!-- @endforeach
        <input type="file" id="imagen" class="form-control" name="imagen[]" multiple><br>--> 

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    </div>
</body>
</html>