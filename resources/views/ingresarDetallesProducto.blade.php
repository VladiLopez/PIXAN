<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Producto</title>
</head>
<body>
    <div>
        <a href="/">INICIO</a>
        <a href="/detallesproductos">MIS PRODUCTOS</a>
    </div>
    <div>
    <h1>Ingresar Nuevo Producto</h1>
    <form action="{{ route('detallesproductos.store') }}" method="POST" enctype="multipart/form-data" >
        @csrf
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre"><br>

        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio"><br>

        <div>
            <textarea id="descripcion" name="descripcion" placeholder="Describa el producto:"></textarea>
            <label for="descripcion" >Descripción:</label>
        </div>
        
        <div>
            <textarea id="caracteristicas" name="caracteristicas" placeholder="Describa las caracteristias:"></textarea>
            <label for="caracteristicas">Características:</label>
        </div>
        

        <label>Colores:</label><br>
        <div>
            <input type="checkbox" id="verde" name="colores[]" value="verde">
            <label for="verde">Verde</label><br>
            
            <input type="checkbox" id="rojo" name="colores[]" value="rojo">
            <label for="rojo">Rojo</label><br>
            
            <input type="checkbox" id="amarillo" name="colores[]" value="amarillo">
            <label for="amarillo">Amarillo</label><br>
            
            <input type="checkbox" id="blanco" name="colores[]" value="blanco">
            <label for="blanco">Blanco</label><br>
            
            <input type="checkbox" id="negro" name="colores[]" value="negro">
            <label for="negro">Negro</label><br>
            
            <input type="checkbox" id="azul" name="colores[]" value="azul">
            <label for="azul">Azul</label><br>

            <input type="checkbox" id="gris" name="colores[]" value="gris">
            <label for="gris">Gris</label><br>
        </div>

        <label for="imagenes">Imágenes:</label><br>
        <input type="file" id="imagenes" name="imagenes[]" multiple><br> <!-- Campo de entrada para seleccionar múltiples imágenes -->

        <label for="tiempo_entrega">Tiempo de Entrega:</label><br>
        <input type="text" id="tiempo_entrega" name="tiempo_entrega"><br>

        <button type="submit">Guardar</button>
    </form>
    </div>
</body>
</html>
