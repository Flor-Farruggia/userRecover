<?php
session_start();
$_SESSION['nombre'];
$_SESSION['apellido'];

if(!isset($_SESSION['on'])){
    $_SESSION['on']=false;
    header("location: login.php");
    exit();
}else{
    echo 'Bienvenido: '.$_SESSION['nombre'].' '.$_SESSION['apellido']; 
}
