<?php date_default_timezone_set("America/Lima"); 
    $dni=$_GET['dni']
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credipyme Solución</title>
    <!-- <link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <link rel="stylesheet" href="css/estiloscontrolasistencia.css">
    <script src="js/jquery.js"></script>
    <script src="js/sweetalert2.js"></script>
    
</head>
<body>

<header>
    <img src="img/logo.svg" alt="" id="logo">
</header>
<div id="backg">
    <aside>
        <img src="img/imagen.svg" alt="">
    </aside>
<section>
    <article>
        <img src="img/user.svg" alt="" id="user">
        <h2>CONTROL <br>
        DE ASISTENCIA</h2>
        <div id="reloj" class='has-text-link'></div>
        <?php   $agencia = $_GET['agencia'];
                $nombres = $_GET['nombres'];
        ?>
        <p style="color: #868E96; margin: 0;"><?= $nombres?></p>
        <br>
        <form action="temperatura_save.php" method="post" id='formulario'>
            <h1 class="subtitle is-3 has-text-centered">Ingresar Temperatura</h1>
            <input class="input is-focused is-medium" type="text" placeholder="Ingrese temperatura" id='temperatura' name='temperatura'>
            <input type="hidden" name="dni" value=<?php echo $dni; ?>>
            <input type="hidden" name="fecha" value=<?php echo date("Y-m-d")?>>
            <button class="button is-link is-medium is-fullwidth" id='enviartemperatura'>Enviar</button>
        </form>
        <br>
        <div id="ubicacion" ><p style="color:#7BAA25;"><strong><?= $agencia?></strong></p></div>
    </article>
</section>
    <div id="map">.</div>
    <script src="js/main.js"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVCIb8IzLUkVwxSCV1rBJbTyWYfxOo0LY&callback=initMap">
    </script>
    
</div>
<script src="js/reloj.js"></script>

</body>
</html>

<?php
//header( "refresh:1; url=index.html" );
?>