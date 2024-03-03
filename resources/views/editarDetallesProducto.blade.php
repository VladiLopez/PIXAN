<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <div>
        <a href="/">INICIO</a>
        <a href="/detallesproductos">MIS PRODUCTOS</a>
    </div>
    <div>
    <h1>Editar Producto</h1>
    <form action="{{ route('detallesproductos.update', $detalleProducto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="{{ $detalleProducto->nombre }}"><br>

        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" value="{{ $detalleProducto->precio }}"><br>

        <div>
            <textarea id="descripcion" name="descripcion" placeholder="Describa el producto :p">{{ $detalleProducto->descripcion }}</textarea>
            <label for="descripcion">Descripción:</label>
        </div>
        
        <div>
            <textarea id="caracteristicas" name="caracteristicas" placeholder="Describa las caracteristias :p">{{ $detalleProducto->caracteristicas }}</textarea>
            <label for="caracteristicas">Características:</label>
        </div>
        
        <label>Colores:</label><br>
        <div>
            <input type="checkbox" id="verde" name="colores[]" value="verde" {{ in_array('verde', json_decode($detalleProducto->colores)) ? 'checked' : '' }}>
            <label for="verde">Verde</label><br>
            
            <input type="checkbox" id="rojo" name="colores[]" value="rojo" {{ in_array('rojo', json_decode($detalleProducto->colores)) ? 'checked' : '' }}>
            <label for="rojo">Rojo</label><br>
            
            <input type="checkbox" id="amarillo" name="colores[]" value="amarillo" {{ in_array('amarillo', json_decode($detalleProducto->colores)) ? 'checked' : '' }}>
            <label for="amarillo">Amarillo</label><br>
            
            <input type="checkbox" id="blanco" name="colores[]" value="blanco" {{ in_array('blanco', json_decode($detalleProducto->colores)) ? 'checked' : '' }}>
            <label for="blanco">Blanco</label><br>
            
            <input type="checkbox" id="negro" name="colores[]" value="negro" {{ in_array('negro', json_decode($detalleProducto->colores)) ? 'checked' : '' }}>
            <label for="negro">Negro</label><br>
            
            <input type="checkbox" id="azul" name="colores[]" value="azul" {{ in_array('azul', json_decode($detalleProducto->colores)) ? 'checked' : '' }}>
            <label for="azul">Azul</label><br>

            <input type="checkbox" id="gris" name="colores[]" value="azul" {{ in_array('gris', json_decode($detalleProducto->colores)) ? 'checked' : '' }}>
            <label for="gris">Gris</label><br>
        </div>

        <label for="imagenes">Imágenes:</label><br>
        <!-- Aquí puedes mostrar las imágenes actuales del producto -->
        @foreach(explode(',', $detalleProducto->imagenes) as $imagen)
        <div>
            <img src="{{ asset('storage/' . $imagen) }}" alt="Imagen del Producto">   
        </div>
        @endforeach
        <input type="file" id="imagenes" name="imagenes[]" multiple><br>

        <label for="tiempo_entrega">Tiempo de Entrega:</label><br>
        <input type="text" id="tiempo_entrega" name="tiempo_entrega" value="{{ $detalleProducto->tiempo_entrega }}"><br>

        <button type="submit">Guardar</button>
    </form>
    </div>
</body>
</html>
