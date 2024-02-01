<?php 
require_once "MYSQL.php";
$mySql = new MYSQL();
$mySql->conectar();
$consultaUsuario = $mySql->efectuarConsulta("select usuario.imagen,usuario.idUsuario,usuario.nombreUsuario,usuario.correo,rol.descripcion from tallercamilo.usuario INNER JOIN tallercamilo.rol ON usuario.frRol=rol.idRol;");


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./styleProducto.css">
  <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">



  <!-- aca van a ir los estilos-->
  <style>
    .contenedorUsuario {
      padding-top: 10px;
  padding-bottom: 10px;
  border-top: 2px solid  black;

  background-color: #02587A;
  position: fixed;
  bottom: 0; /* Fija el elemento en la parte inferior */ 
     left: 1;
    width: 100%; /* Establece el ancho en 100% */
    z-index: 999; /* Usa un valor positivo para z-index */
}
body{
  margin-bottom: 100px;
}
.colDatosUsuario{
  display: flex;
  align-items: center;
  flex-direction: column;
  align-content: center;
  justify-content: center;

}
.colDatosUsuario label{
  color: white;
font-family: Arial, Helvetica, sans-serif;
font-size: 20px;
}
  </style>
  <!------------------------------>
</head>
<body>
      <!-- aca voy a colocar el header -->
<div style=" margin-bottom: 60px;" class="row header">
<div class="col"><nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">Tienda Restrepo</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
  </div>
</nav>
</div>
</div>

<!-- esta es el narv donde puede selecionar para agregar -->
<div style="  padding: 0%;" class="col">
    <nav style="  padding: 0px;" class="navbar navbar-dark bg-dark">
  <div style=" background-color: #012E40;padding: 10px" class="container-fluid">
    <a style="  font-weight: 700;font-size: 30px;" class="navbar-brand" href="#">Usuarios</a>
    </div>
  </div>
</nav>
    </div>
</div>
<!------------------------------------------------------------------------------------------------->

<div class="row">
  <!-- aca voy a poner donde va ir el nav con los direciones a coger -->
<div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 colItem">
  <nav id="navItem" style=" padding: 20px;" >
    <ul id="itemUser" style=" padding-bottom: 100px;  padding-left: 0px;" class="d-flex flex-md-column flex-lg-column flex-xl-column align-items-star cabeceraItem">
      <li id="item1" class="item"><a href="#">Usuarios</a></li>
      <li id="item2" class="item"><a href="productos.php">Productos</a></li>
      <li id="item3" class="item"><a href="#">Estadisticas</a></li>
      <li id="item4" class="item"><a id="salir" href="#">Salir</a></li>
    </ul>
  </nav>
</div>

  <!-- aca voy a poner donde va ir la tabla de los productos -->
<div  style=" padding: 0px;" class="col-sm-12 col-md-10 col-lg-10 col-xl-10">
<table class="table table-success table-striped">
 <thead>
    <tr>
        <th>Imagen</th>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>ROL</th>
        <th></th>
    </tr>
 </thead>
 <tbody>
<?php
while($fila = mysqli_fetch_array($consultaUsuario)){?>
<form action="">
<tr>
<?php


// Verifica si el archivo existe
if (file_exists('./imagenes/'.$fila[0])) {
  // El archivo existe, puedes mostrar la imagen
  echo '<td><img style="height: 80px;  width: 80px;  border-radius: 30px;
  " src="./imagenes/'.$fila[0].'" alt="" srcset="./imagenes/'.$fila[0].'"></td>';
} else {
  // El archivo no existe, puedes mostrar una imagen predeterminada o algún mensaje de error
  echo '<td><img src="ruta/a/tu/carpeta/imagen_predeterminada.jpg" alt="Imagen no encontrada"></td>';
}
?>
  <td><?php echo $fila[1]?></td>
  <td><?php echo $fila[2]?></td>
  <td><?php echo $fila[3]?></td>
  <td><?php echo $fila[4]?></td>
  <!-- aca voy a poner el boton donde va poner las opciones de editar o eliminar -->
  <td>
      <div class="btn-group">
<button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
  Detalle
</button>
<ul class="dropdown-menu">
  <li><a class="dropdown-item" href="#">Ver</a></li>
  <li><a  class="dropdown-item" href="#"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: transparent;color: black; border: none;" data-bs-whatever="@mdo" onclick="idProductoEditar('<?php echo $fila[0] ?>')">Editar</button></a></li>
  <li><a onclick="idProducto('<?php echo $fila[0] ?>')"  class="dropdown-item" href="#">Eliminar</a></li>

  <li><hr class="dropdown-divider"></li>
  <li><a class="dropdown-item" href="#">Otro</a></li>
</ul>
</div>



</td>

  <!------------------------------------------------------------>
</tr>
</form>

<?php }?>



<!--aca voy hacer donde la va ir los datos del Usuario que ingreso-->
<div class="row contenedorUsuario">
  <div class="col-4">
    <img style=" width: 100px;height: 100px;   border-radius: 15px;" src="./imagenes/<?php echo $_SESSION['imagen']; ?>" alt="Usuario" srcset="./imagenes/<?php echo $_SESSION['imagen']; ?>">
  </div>
    <div class="col-8 colDatosUsuario align-items-xl-start">
<div class="datosUsario">
<i class="bi bi-person-circle"></i>
  <label for="">Nombre:</label>
  <label for=""><?php echo $_SESSION['usuario']; ?></label>
</div>
<div class="datosUsario">
<i class="bi bi-person-rolodex"></i>
  <label for="">Rol:</label>
  <label for="">ADMIN</label>
</div>

    </div>
  </div>
  <!----------------------------------------------------------------------->

<script src="./isset/js/mainProductos.js"></script>
<script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
let item4 = document.getElementById("item4");

item4.addEventListener("click", () => {
  
  Swal.fire({
    title: "Estas seguro de salir?",
    text: "Tendras que volver a iniciar Sesion!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "SI!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "users.php";
    }
  });
});
</script>