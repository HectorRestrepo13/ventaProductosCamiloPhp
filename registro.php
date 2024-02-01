
<?php


if (
    isset($_POST['correo'], $_POST['contra'], $_POST['nombre'], $_POST['usuario']) &&
    !empty($_POST['correo']) && !empty($_POST['contra']) &&
    !empty($_POST['nombre']) && !empty($_POST['usuario'])
) {
   
    require_once 'MYSQL.php';

  
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];
    $nombre = $_POST['nombre'];
    $alias = $_POST['usuario'];
    $imagenUsuario=$_FILES['imagenUsuario']['name'];
   
    $mysql = new MYSQL();
    $mysql->conectar();

  
    $consultaExistencia = $mysql->efectuarConsulta("select * from tallercamilo.usuario where usuario = '$alias'");

    if (mysqli_num_rows($consultaExistencia) > 0 ) {
      
        header("location: formTRegistro.php");
        exit(); 
    }else{

//aca voy a colocar para verificar la imagen 
if(isset($imagenUsuario) && $imagenUsuario !="")
{

 $tipo = $_FILES['imagenUsuario']['type'];
 $tem = $_FILES['imagenUsuario']['tmp_name'];
if(!((strpos($tipo,'gif') ||strpos($tipo,'jpeg') || strpos($tipo,'webp') )))
{
$_SESSION['mensaje']="solo se permiten archivos git,jpeg,webp";
$_SESSION['tipo']="warning";
header('location: formTRegistro.php');
}
else{


$consulta= $mysql->efectuarConsulta("insert into tallercamilo.usuario(nombreUsuario,usuario,contraUsuario,correo,imagen) values('$nombre','$alias','$contra','$correo','$imagenUsuario')");
$mysql->desconectar();

if($consulta)
{
 move_uploaded_file($tem,'imagenes/'.$imagenUsuario);
 
 header('location: users.php');
}
else{
 $_SESSION['mensaje']="Ocurrio un error al Registrarse";
 $_SESSION['tipo']="danger";
 header("location: productos.php");
 }
 }



 }
//-----------------------------------------------------
















      
    }
}
else{
   // header("location: formTRegistro.php");
}