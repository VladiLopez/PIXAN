<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Incluye jQuery -->
    <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
</head>
<body>
    <div class="botones-container">
        <a href="/">INICIO</a>
        <a href="{{ route('catalogo.productos') }}">CATÁLOGO</a>
    </div>
    <div class="container">
        <h1 class="mt-5">Comentarios del Producto</h1>

        <!-- Formulario para agregar un nuevo comentario -->
        <div class="nuevo-comentario">
            <h2>Agregar un nuevo comentario:</h2>
            <form id="comentarioForm" action="{{ route('comentario.agregar', ['id' => $detallesProducto->id]) }}" method="post">
                @csrf
                <textarea name="contenido" id="contenido" placeholder="Escribe tu comentario aquí" maxlength="250" class="form-control"></textarea>
                @error('contenido')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Enviar comentario</button>
            </form>
         </div>

        <!-- Contenedor de comentarios -->
        <div class="comentarios-container">
            @forelse($detallesProducto->comentarios as $comentario)
                <div class="comentario">
                    <p>{{ $comentario->contenido }}</p>
                </div>
            @empty
                <p>No hay comentarios aún.</p>
            @endforelse
        </div>
    </div>

    <script>
        // Función para validar el contenido del textarea antes de enviar el formulario
        function validarFormulario() {
            var contenido = document.getElementById("contenido").value.trim();

            if (contenido.length === 0) {
                alert("Por favor, ingrese un comentario.");
                return false;
            } else if (contenido.length > 250) {
                alert("El comentario no puede tener más de 250 caracteres.");
                return false;
            }

            return true;
        }

        // Asignar la función de validación al evento onsubmit del formulario
        document.getElementById("comentarioForm").onsubmit = validarFormulario;
    </script>
</body>
</html>
