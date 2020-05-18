<?php
function conectar(){

    // $user="credipy_fralch";
    // $pass="Siempree08";
    // $server="67.205.125.21";
    // $db="credipy_sistema";
    $user="root";
    $pass="";
    $server="localhost";
    $db="credipy_sistema";

    $con=mysqli_connect($server,$user,$pass,$db) or die ("error en la conexióoooneszzz");
    mysqli_set_charset($con, 'utf8');
    return $con;
}
