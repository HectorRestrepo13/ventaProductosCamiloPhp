<?php
session_start();
// se verifica que existan datos en el formulario

if (isset($_POST['nombreProducto']) && !empty($_POST['nombreProducto']) &&
    isset($_POST['cantidadProducto']) && !empty($_POST['cantidadProducto'])
    &&
    isset($_POST['idUsuario']) && !empty($_POST['idUsuario']) && isset($_FILES['imagenProducto']) && $_FILES['imagenProducto']['error'] == 0) 
    {
        $nombreProducto =$_POST['nombreProducto'];
        $cantidadProducto =$_POST['cantidadProducto'];
        $idUsuario =$_POST['idUsuario'];
        $imagenProducto = $_FILES['imagenProducto']['name'];
        
       if(isset($imagenProducto) && $imagenProducto !="")
       {

        $tipo = $_FILES['imagenProducto']['type'];
        $tem = $_FILES['imagenProducto']['tmp_name'];
     if(!((strpos($tipo,'gif') ||strpos($tipo,'jpeg') || strpos($tipo,'webp') )))
     {
      $_SESSION['mensaje']="solo se permiten archivos git,jpeg,webp";
      $_SESSION['tipo']="warning";
     header('location: productos.php');
     }
     else{
      require_once 'MYSQL.php';
      $mysql = new MYSQL();
      $mysql->conectar();
    
      $consulta= $mysql->efectuarConsulta("insert into tallercamilo.productos(nombreProducto,cantidadProducto,imagenProducto,fk_usuario) values('$nombreProducto',$cantidadProducto,'$imagenProducto',$idUsuario)");
      $mysql->desconectar();

      if($consulta)
      {
        move_uploaded_file($tem,'imagenes/'.$imagenProducto);
        $_SESSION['mensaje']="Producto Agregado con exito";
        $_SESSION['tipo']="success";
        header('location: productos.php');
      }
      else{
        $_SESSION['mensaje']="Ocurrio un error al Guardar el Producto";
        $_SESSION['tipo']="danger";
        header("location: productos.php");
        }
        }


       
        }
        
   
        else
        { 
         
          
        $_SESSION['mensaje']="Ruta Vacia";
        $_SESSION['tipo']="warning";
        header("location: productos.php");
    
        }
        
     
    
      
    }
    else
    { 
      
     
     $_SESSION['mensaje']="Faltan datos por llenar";
     $_SESSION['tipo']="warning";
     header("location: productos.php");

    }
?>
