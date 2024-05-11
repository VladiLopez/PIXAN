<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="" />
     <meta name="author" content="" />

     <!-- Title -->
     <title>Perdon, bye...</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
     <link rel="stylesheet" href="{{ asset('css/stylesIndex.css') }}">
     <link rel="stylesheet" href="{{ asset('css/403.css') }}">
</head>

<body class="bg-dark text-white py-5">
     <div class="container py-5">
          <div class="row">
               <div class="col-md-2 text-center">
                    <p><i class="fa fa-exclamation-triangle fa-5x"></i><br/>Status Code: 403</p>
               </div>
               <div class="col-md-10">
                    <h3>Oye!!!! Tranquilo viejo...</h3>
                    <p>Perdon, pero no tienes permisos para acceder a este recurso.<br/>Por favor regrese a la página anterior para continuar navegando.</p>
                    <a class="btn btn-danger" href="javascript:history.back()">Regresar</a>
               </div>
          </div>
     </div>

     <div id="footer" class="text-center">
          PIXAN 2024.
     </div>
</body>

</html>