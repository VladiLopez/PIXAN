<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylesIngresar.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="/stockmateriales">MIS MATERIALES</a>
    </div>
    <div class="container mt-1">
        <h1 class="section-heading text-uppercase text-center">Editar Material</h1>
        <form action="{{ route('stockmateriales.update', $stockMateriales->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="nombre" class="form-label">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $stockMateriales->nombre) }}"><br>
            @error('nombre')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-floating">
                <textarea id="caracteristicas" class="form-control" style="height: 100px;" name="caracteristicas" placeholder="Describa las características: ">{{ old('caracteristicas', $stockMateriales->caracteristicas) }}</textarea>
                <label for="caracteristicas">Características:</label>
            </div>
            @error('caracteristicas')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="marca" class="form-label">Nombre:</label><br>
            <input type="text" id="marca" name="marca" class="form-control" value="{{ old('marca', $stockMateriales->marca) }}"><br>
            @error('marca')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        <label>Colores:</label><br>
            <div class="d-flex flex-row">
                <input type="checkbox" class="form-check-input m-2 me-0 " id="verde" name="colores[]" value="#51E033">
                <label class="m-1" for="verde">Verde</label><br>
                
                <input type="checkbox" class="form-check-input m-2 me-0" id="rojo" name="colores[]" value="#E10600">
                <label class="m-1" for="rojo">Rojo</label><br>
                
                <input type="checkbox" class="form-check-input m-2 me-0" id="amarillo" name="colores[]" value="#E1C401">
                <label class="m-1" for="amarillo">Amarillo</label><br>
                
                <input type="checkbox" class="form-check-input m-2 me-0" id="blanco" name="colores[]" value="#FFFFFF">
                <label class="m-1" for="blanco">Blanco</label><br>
                
                <input type="checkbox" class="form-check-input m-2 me-0" id="negro" name="colores[]" value="#000000">
                <label class="m-1" for="negro">Negro</label><br>
                
                <input type="checkbox" class="form-check-input m-2 me-0" id="azul" name="colores[]" value="#000BE0">
                <label class="m-1" for="azul">Azul</label><br>

                <input type="checkbox" class="form-check-input m-2 me-0" id="gris" name="colores[]" value="	#808080">
                <label class="m-1" for="gris">Gris</label><br>
            </div>
            @error('colores')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        <label for="imagen" class="form-label">Imágen:</label><br>
            @foreach(explode(',', $stockMateriales->imagen) as $image)
                <div style="width: 100px;">
                    <img class="img-thumbnail" src="{{ asset('storage/' . $image) }}" alt="Imagen del Material">   
                </div>
            @endforeach
            <input type="file" id="imagen" class="form-control" name="imagen[]" multiple><br>
            @error('imagen')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</body>
</html>