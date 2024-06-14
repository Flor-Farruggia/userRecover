<?php
session_start();
/**if(!isset($_SESSION['on'])){
    $_SESSION['on']=false;
    exit();
}else{
    if($_SESSION['on']==true){
        header("location: bienvenido.php");
    } 
}*/

$userId = '';

$error_id = '';

//validaciones
#Existe boton?
if (isset($_POST['ingreso'])) {

    $errorFlag = false;

    function validacion($campo, $min, $max, $campoName){
        $msg = '';
        $error = false;
        $campo2 = '';

        if(!isset($_POST[$campo])){
            $msg = "No existe campo ".$campoName;
            $error = true;
        }else{
            $campo2 = trim($_POST[$campo]);
            if (empty($campo2)) {
                $msg = 'No puede estar vacío el campo '.$campoName;
                $error = true;
            }else{
                if(strlen($campo2) < $min || strlen($campo2) > $max) {
                    $msg = 'Por favor ingrese entre '.$min.' y '.$max.' caracteres';
                    $error = true;
                } else {
                }
            }
        }
        $resultado['msg'] =$msg;
        $resultado['error'] =$error;
        $resultado['campo2'] =$campo2;

        return $resultado;
    }

    $valUserId = validacion('userId', 1, 3, 'usuarioId');

    if($valUserId['error']){
        $error_id = $valUserId['msg'];
        $errorFlag = true;
    } 
    } else {
        $userId = $valUserId['campo2'];

        //CONSULTA A DB

        $dsn = "mysql:host=localhost;dbname=pruebita;charset=utf8";
        $usuario = "root";
        $password = "";
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        $pdo = new PDO($dsn, $usuario, $password, $opciones);

        // Ejecutar una consulta
        $consulta = "SELECT id_usuario FROM usuarios WHERE $userId";
        $resultado = $pdo->query($consulta);

        // Obtener los resultados de la consulta
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        // Acceder a los datos de la fila


        $fila['columna1'];
        $nombre = $fila['columna2'];
        $apellido = $fila['columna3'];
        $fila['columna4'];


        }
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido'] = $apellido;  
    }
//FINAL VALIDACIONES

if($errorFlag==false){
    $_SESSION['on']=true;
    header("location: bienvenido.php");
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <main class="row flex flex-justify-center">
        <form class="col_4 login_cont" method="POST">
            <div class="col_12">
                <h1>Iniciar Sesión con N° de Usuario</h1>
            </div>
            <div class="col_12 inputs">
                <input type="number" name="userId" placeholder="Ingrese número de usuario" value="<?=$userId?>" autofocus>
                <output class="col_12 msg_error"><?=$error_id?></output>
            </div>
            <div class="col_12 flex flex-justify-center button_log">
                <button type="submit" name="ingreso">Ingresar</button>
            </div>
        </form>
    </main>
</body>
</html>