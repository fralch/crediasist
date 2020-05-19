<?php
date_default_timezone_set("America/Lima");
include ("conectar.php");
include ("detec_os.php");
$con=conectar();
$dni=(int)$_POST['dni'];


//-----------------detectar dispositivo----------
$sistema_operativo = getPlatform($user_agent);
//------------------------------
// date_default_timezone_set("America/Lima");
// $fechaActual = date('Y-m-d H:i:s');
// $hora = (int) date('H');
// $min = (int) date('i');
// $fecha_dc= date_create("now");
// $fecha_dia = date('l');
//---------------------------------------------
$hora = (int) $_POST['hora'];
$min = (int) $_POST['minuto'];

$fecha_dc=date_create("2020-05-18 ".$hora.":".$min.":00");
$fechaActual =  date_format($fecha_dc, "Y/m/d H:i:s");
$fecha_dia =  date_format($fecha_dc, "l");


$hora_form=$hora.":".$min.":00";
$fecha_actual_hora_min =  strtotime($hora_form);

if ($fecha_dia != "Saturday") {


    $consulta=  "SELECT usuarios.nombres,usuarios.agencia,hora_entrada_maniana,hora_entrada_tarde,
                hora_salida_maniana, hora_salida_tarde ,tolerancia
                FROM horarios INNER JOIN horario_asignados ON horarios.id_horario = horario_asignados.id_horario
                INNER JOIN usuarios ON horario_asignados.dni = usuarios.dni
                WHERE usuarios.dni='$dni'";
    $rconsulta=mysqli_query($con,$consulta);

    foreach ($rconsulta as $item) {
        $tolerancia = $item["tolerancia"];

        $entrada_mañ = date_create($item["hora_entrada_maniana"]);
        $entrada_hora_min_mañ= strtotime($item["hora_entrada_maniana"]."+ $tolerancia min" );

        $salida_mañ = date_create($item["hora_salida_maniana"]);
        $salida_hora_min_mañ= strtotime($item["hora_salida_maniana"] );

        $entrada_tar = date_create($item["hora_entrada_tarde"]);
        $entrada_hora_min_tar= strtotime($item["hora_entrada_tarde"."+ $tolerancia min" ] );

        $salida_tar = date_create($item["hora_salida_tarde"]);
        $salida_hora_min_tar= strtotime($item["hora_salida_tarde"] );

        $agencia = $item["agencia"];
        $nombres = $item["nombres"];


        // inreso mañana
        if ($fecha_actual_hora_min<$salida_hora_min_mañ) {
            $insertar="insert into entrada_salidas (fechahora,tipo,dni) values ('$fechaActual','ingreso_mañana','$dni')";
            $insertando=mysqli_query($con,$insertar);

            if ($fecha_actual_hora_min>$entrada_hora_min_mañ) {
                $tarde= date_diff($fecha_dc, $entrada_mañ);
                $tarde = $tarde->format('%i');

                $insertar_tardanza= "INSERT INTO tardanzas( minutos, fecha, dni) VALUES ($tarde,'$fechaActual',$dni)";
                $insertando_tardanza=mysqli_query($con,$insertar_tardanza);
            }
            header("Location: controlasistencia.php?agencia=" . $agencia."&nombres=".$nombres);
            exit();
        }

        // salida mañana
        if ($fecha_actual_hora_min>$entrada_hora_min_mañ and  $fecha_actual_hora_min< $entrada_hora_min_tar) {
            $insertar="insert into entrada_salidas (fechahora,tipo,dni) values ('$fechaActual','salida_mañana','$dni')";
            $insertando=mysqli_query($con,$insertar);
            header("Location: controlasistencia.php?agencia=" . $agencia."&nombres=".$nombres);
            exit();
        }

        // inreso tarde
        if ($fecha_actual_hora_min> $salida_hora_min_mañ and $fecha_actual_hora_min< $salida_hora_min_tar ) {
            $insertar="insert into entrada_salidas (fechahora,tipo,dni) values ('$fechaActual','ingreso_tarde','$dni')";
            $insertando=mysqli_query($con,$insertar);

            if ($fecha_actual_hora_min>$entrada_hora_min_tar) {
                $tarde= date_diff($fecha_dc, $entrada_tar);
                $tarde = $tarde->format('%i');

                $insertar_tardanza= "INSERT INTO tardanzas( minutos, fecha, dni) VALUES ($tarde,'$fechaActual',$dni)";
                $insertando_tardanza=mysqli_query($con,$insertar_tardanza);
            }
            header("Location: controlasistencia.php?agencia=" . $agencia."&nombres=".$nombres);
            exit();
        }

        // salida tarde
        if ($fecha_actual_hora_min>$salida_hora_min_tar) {
            $insertar="insert into entrada_salidas (fechahora,tipo,dni) values ('$fechaActual','salida_tarde','$dni')";
            $insertando=mysqli_query($con,$insertar);
            header("Location: controlasistencia.php?agencia=" . $agencia."&nombres=".$nombres);
            exit();
        }
    }

}else{

    $consulta=  "SELECT usuarios.nombres,usuarios.agencia,hora_entrada_maniana_s,hora_salida_maniana_s ,tolerancia
                FROM horarios
                INNER JOIN horario_asignados ON horarios.id_horario = horario_asignados.id_horario
                INNER JOIN usuarios ON horario_asignados.dni = usuarios.dni
                WHERE usuarios.dni='$dni' ";
    $rconsulta=mysqli_query($con,$consulta);

    foreach ($rconsulta as $item) {

        $entrada_mañ = date_create($item["hora_entrada_maniana_s"]);
        $entrada_hora_min_mañ= strtotime($item["hora_entrada_maniana_s"."+ $tolerancia min" ] );

        $salida_mañ = date_create($item["hora_salida_maniana_s"]);
        $salida_hora_min_mañ= strtotime($item["hora_salida_maniana_s"] );



        $agencia = $item["agencia"];
        $nombres = $item["nombres"];


        // inreso mañana
        if ($fecha_actual_hora_min<$salida_hora_min_mañ) {
            $insertar="insert into entrada_salidas (fechahora,tipo,dni) values ('$fechaActual','ingreso_mañana','$dni')";
            $insertando=mysqli_query($con,$insertar);

            if ($fecha_actual_hora_min>$entrada_hora_min_mañ) {
                $tarde= date_diff($fecha_dc, $entrada_mañ);
                $tarde = $tarde->format('%i');

                $insertar_tardanza= "INSERT INTO tardanzas( minutos, fecha, dni) VALUES ($tarde,'$fechaActual',$dni)";
                $insertando_tardanza=mysqli_query($con,$insertar_tardanza);
            }
            header("Location: controlasistencia.php?agencia=" . $agencia."&nombres=".$nombres);
            exit();
        }

        // salida mañana
        if ( $fecha_actual_hora_min> $salida_hora_min_mañ) {
            $insertar="insert into entrada_salidas (fechahora,tipo,dni) values ('$fechaActual','salida_mañana','$dni')";
            $insertando=mysqli_query($con,$insertar);
            header("Location: controlasistencia.php?agencia=" . $agencia."&nombres=".$nombres);
            exit();
        }

    }


}
