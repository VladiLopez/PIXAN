<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Producto</title>
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
    <div class="container mt-1">
    <h1 class="section-heading text-uppercase text-center">Ingresar Nuevo Material</h1>
    <form action="{{ route('stockmateriales.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <label for="nombre" class="form-label">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}">
        @error('nombre')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        
        <div class="form-floating">
            <textarea id="caracteristicas" class="form-control" style="height: 100px;" name="caracteristicas" placeholder="Describa las caracteristias:">{{ old('caracteristicas') }}</textarea>
            <label for="caracteristicas">Características:</label>
        </div>
        @error('caracteristicas')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="form-floating">
            <textarea id="marca" class="form-control" style="height: 100px;" name="marca" placeholder="Describa las caracteristias :p">{{ old('marca') }}</textarea>
            <label for="marca">Marca:</label>
        </div>
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
        <input type="file" id="imagenes" class="form-control" name="imagen[]">
        @error('imagen')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
    </div>
</body>
</html>
