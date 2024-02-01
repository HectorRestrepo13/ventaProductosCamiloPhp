<?php     

$id=$_POST['produ'];
$nuevaCantidad =$_POST['nuevaCantidad'];
$nuevaImagen=$_FILES['nuevaImagen']['name'];

require_once 'MYSQL.php';
$mysql = new MYSQL();

$mysql->conectar();
if(isset($nuevaImagen) && $nuevaImagen !="" && isset($nuevaCantidad) && $nuevaCantidad !="" )
{
 
    $tipo = $_FILES['nuevaImagen']['type'];
    $tem = $_FILES['nuevaImagen']['tmp_name'];
 if(!((strpos($tipo,'gif') ||strpos($tipo,'jpeg') || strpos($tipo,'webp') )))
 {
  $_SESSION['mensaje']="solo se permiten archivos git,jpeg,webp";
  $_SESSION['tipo']="warning";
 header('location: productos.php');
 }
 else{
   $consulta = $mysql->efectuarConsulta("update tallercamilo.productos set cantidadProducto=$nuevaCantidad, imagenProducto='$nuevaImagen' where id=$id");
   if($consulta)
   {
    //aca coloco un mensaje de que se edito corretamente
    $_SESSION['mensaje']="Se edito corretamente";
    $_SESSION['tipo']="success";
    move_uploaded_file($tem,'imagenes/'.$nuevaImagen);
    header("location: productos.php");
   }
   else
   {

    //aca coloco un mensaje de que hubo un error al guardar la imagen
    $_SESSION['mensaje']="Hubo un error al guardar la imagen ";
    $_SESSION['tipo']="warning";
    header("location: productos.php");

   }
 }



   
}else if(isset($nuevaImagen) && $nuevaImagen !="" && empty($nuevaCantidad) )
{

    $tipo = $_FILES['nuevaImagen']['type'];
    $tem = $_FILES['nuevaImagen']['tmp_name'];
 if(!((strpos($tipo,'gif') ||strpos($tipo,'jpeg') || strpos($tipo,'webp') )))
 {
    //aca coloco un mensaje de que no se admite ese tipo de archivo y lo recargo
    $_SESSION['mensaje']="solo se permiten archivos git,jpeg,webp";
    $_SESSION['tipo']="warning";

    header("location: productos.php");
 }
 else{
$consulta = $mysql->efectuarConsulta("update tallercamilo.productos set imagenProducto='$nuevaImagen' where id=$id");
if($consulta)
{
    move_uploaded_file($tem,'imagenes/'.$nuevaImagen);
    //aca coloco un mensaje de que se guardo con exito y lo recargo
    $_SESSION['mensaje']="Se Edito con exito";
    $_SESSION['tipo']="success";

    header("location: productos.php");

}
else{
      //aca coloco un mensaje de que hubo un error al guardar  y lo recargo
      $_SESSION['mensaje']="Hubo un error al guardar la imagen";
      $_SESSION['tipo']="warning";

      header("location: productos.php");
}

 }

}
else if(empty($nuevaImagen) && $nuevaImagen =="" && isset($nuevaCantidad) && $nuevaCantidad !="" )
{
   $consulta= $mysql->efectuarConsulta("update tallercamilo.productos set cantidadProducto=$nuevaCantidad where id=$id");
if($consulta)
{
        //aca coloco un mensaje de que se guardo con exito y lo recargo
        $_SESSION['mensaje']="se Edito con exito";
        $_SESSION['tipo']="success";

        header("location: productos.php");
}
else{
     //aca coloco un mensaje de que hubo un error al guardar  y lo recargo
     $_SESSION['mensaje']="hubo un erro al editar la Cantidad";
     $_SESSION['tipo']="warning";

     header("location: productos.php");
}
}





$mysql->desconectar();



?>

