
<?php
session_start();

//controla el inicio de sesion
//se verifica que existan datos en el formulario

if (isset($_POST['correo']) && !empty($_POST['correo']) && isset($_POST['contra']) && !empty($_POST['contra'])) {
    //se hace el llamado del modelo de conexion y consultas
    require_once 'MYSQL.php';
    //se capturan las variables que vienen desde el formulario
    $user = $_POST['correo'];
    $pass = $_POST['contra'];

    //se instancia la clase, es decir, se llama para poder usar sus metodos

    $mysql = new MYSQL();
    $mysql->conectar();
    $usuario = $mysql->efectuarConsulta("select * from tallercamilo.usuario where usuario.correo ='$user' and usuario.contraUsuario ='$pass'");

    $mysql->desconectar();
    $fila = mysqli_fetch_assoc($usuario);
    $_SESSION['usuario']=$fila['nombreUsuario'];
    $_SESSION['imagen']=$fila['imagen'];
    //se verifica si devolvio algo la consulta si o lo hizo es porque no existe 

    if (mysqli_num_rows($usuario) > 0) {
        header("location: productos.php");   
    } else {
        //de lo contrario no avanza del login
        header("location: users.php");
    }
}
else{
    header("location:users.php");
}