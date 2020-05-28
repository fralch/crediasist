<?php

include ("conectar.php");
$con=conectar();

$dni=$_POST['dni'];
$fecha=$_POST['fecha'];
$temperatura=(float)$_POST['temperatura'];


if ($temperatura!=0) {
    $insertar_temperatura= "INSERT INTO covid_temperatura( dni, fecha, temperatura) VALUES ($dni,'$fecha',$temperatura)";
    $insertando_temp=mysqli_query($con,$insertar_temperatura);

    header( "refresh:1; url=index.html" );
    exit();  
}else{
    echo "<script>alert('Ingrese la temperatura correctamente -> ".$temperatura."')</script>";
    echo "<script>window.history.back();</script>";
}