
<?php
require_once 'MYSQL.php';
$mysql = new MYSQL();
$mysql->conectar();
$consulta = $mysql->efectuarConsulta("select productos.id,productos.nombreProducto,productos.cantidadProducto,productos.imagenProducto,usuario.nombreUsuario from tallercamilo.productos INNER JOIN tallercamilo.usuario ON tallercamilo.productos.fk_usuario=usuario.idUsuario;");
$mysql->desconectar();

$mysql->conectar();
$traerUsuarios = $mysql->efectuarConsulta("select idUsuario,nombreUsuario from tallercamilo.usuario");
$mysql->desconectar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <title>Restrepos</title>
</head>
<body>
  





<div   class="container-fluid">
 
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



<!-- aca voy a colocar donde pregunta si tiene un mensaje en el $_session y si tiene que se coloque el alert-->
<?php if(isset($_SESSION['mensaje'])){ ?>
<div class="alert alert-<?php echo $_SESSION['tipo'] ?> alert-dismissible fade show" role="alert">
  <strong>Atencion</strong> <?php echo $_SESSION['mensaje'] ?>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['tipo']);  unset($_SESSION['mensaje']);  } ?>
<!------------------------------------------->
<div class="row">


  <!-- esta es el narv donde puede selecionar para agregar -->
    <div style="  padding: 0%;" class="col">
    <nav style="  padding: 0px;" class="navbar navbar-dark bg-dark">
  <div style=" background-color: #012E40;padding: 10px" class="container-fluid">
    <a style="  font-weight: 700;font-size: 30px;" class="navbar-brand" href="#">Productos <a href="./reporteProductosPDF.php">Convertir PDF</a></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Agregar</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      
      <div class="offcanvas-body">
      <form  action="codiProductos.php"  method="post" enctype="multipart/form-data">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li style=" margin-bottom: 30px;"class="nav-item">
          <input name="nombreProducto" class="form-control me-2" type="search" placeholder="Nombre" aria-label="Search">
          </li>
          <li class="nav-item">
          <input name="cantidadProducto" class="form-control me-2" type="search" placeholder="Cantidad" aria-label="Search">
          </li>
          
          <li class="nav-item dropdown">
            <input id="idUsuario" name="idUsuario" type="text" hidden >
            <a  id="selecioneUsuario" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Selecione Usuario
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
    <?php while ($user = mysqli_fetch_array($traerUsuarios)) { ?>
        <li>
            <a class="dropdown-item hola" href="#" onclick="obtenerValor('<?php echo $user[1] ?>','<?php echo $user[0] ?>')">
                <button type="button" class="btn-Nombre"><?php echo $user[1] ?></button>
            </a>
        </li>
    <?php } ?>
</ul>
          </li>
        </ul>
        
          <input name="imagenProducto" class="form-control me-2" type="file" placeholder="Selecione Imagen" aria-label="Search">
          <button style=" margin-top: 30px;" class="btn btn-success" type="submit">Guardar</button>
        
        </form>
      </div>
    
    </div>
  </div>
</nav>
    </div>
</div>


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
        <th>Cantidad</th>
        <th>Usuario</th>
        <th></th>
    </tr>
 </thead>
 <tbody>
<?php
while($fila = mysqli_fetch_array($consulta)){?>
<form action="">
<tr>
<?php


// Verifica si el archivo existe
if (file_exists('./imagenes/'.$fila[3])) {
    // El archivo existe, puedes mostrar la imagen
    echo '<td><img style="height: 80px;  width: 80px;  border-radius: 30px;
    " src="./imagenes/'.$fila[3].'" alt="" srcset="./imagenes/'.$fila[3].'"></td>';
} else {
    // El archivo no existe, puedes mostrar una imagen predeterminada o algún mensaje de error
    echo '<td><img src="ruta/a/tu/carpeta/imagen_predeterminada.jpg" alt="Imagen no encontrada"></td>';
}
?>
    <td><?php echo $fila[0]?></td>
    <td><?php echo $fila[1]?></td>
    <td><?php echo $fila[2]?></td>
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

<!-- aca voy a colocar el modal que se desplegara cuando le unda editar para que ingrese los datos a cambiar-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <!--aca voy hacer el formulario donde va editar y va mandar los datos a PHP -->
      <form action="codiEditar_producto.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <input name="produ" id="idPro2" type="text" hidden value="0">
      <h1 class="modal-title fs-5" id="idPro">ID: 2</h1>

      </div>
      <div class="modal-body">
       
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Ingrese una nueva Cantidad:</label>
            <input name="nuevaCantidad" type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Ingrese una nueva Imagen:</label>
            <input name="nuevaImagen" type="file" class="form-control" id="recipient-name">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-------------------------------------------------------------------------------------------------------------------------->
 </tbody>
</table>
</div>
</div>
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

  <!--aca se termina el container-fluid |-->
</div>








<!--aca voy a colocar el javaScrit para coger el id del producto y enviarlo a URL para eliminar -->
<script>
    const idProducto = (id) => {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Estas seguro de Eliminar?",
            text: "Ya no hay vuelta atrás!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Eliminar!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar la solicitud al servidor PHP con el id
                // Utilizando una petición AJAX por ejemplo
                // Aquí puedes adaptar la URL y el método según tu configuración
                fetch('eliminar_producto.php?id=' + id, {
                    method: 'DELETE', // Puedes usar 'POST' u otro método según tu configuración
                })
                .then(response => response.json())
                .then(data => {
                    // Manejar la respuesta del servidor
                    if (data.success) {
                        swalWithBootstrapButtons.fire({
                            title: "Eliminado!",
                            text: "Se eliminó con éxito.",
                            icon: "success"
                            
                        }).then(() => {
                    // Recargar la página
                    location.reload();
                });
                        
                    } else {
                        swalWithBootstrapButtons.fire({
                            title: "Error",
                            text: "Hubo un error al eliminar.",
                            icon: "error"
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    swalWithBootstrapButtons.fire({
                        title: "Error",
                        text: "Hubo un error al comunicarse con el servidor.",
                        icon: "error"
                    });
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Tu archivo imaginario está a salvo :)",
                    icon: "error"
                });
            }
        });
       
    }
  
</script>

<!-- aca voy hacer un scrip de js donde voy a mandar el id al php para editar-->
<script>

const idProductoEditar = (id) => {
  let idPro = document.getElementById("idPro");
  let idPro2 = document.getElementById("idPro2");
  idPro.innerHTML = "ID Producto: "+id;
  idPro2.value =id;
  fetch('codiEditar_producto.php?id='+id,{
  method:'GET',
})



};

</script>


<!-- este va hacer para editar cuando cambia el tamaño de la pantalla-->
<script>
let btnItem = document.getElementById("itemUser");
let item1 = document.getElementById("item1");
let item2 = document.getElementById("item2");
let item3 = document.getElementById("item3");
let item4 = document.getElementById("item4");
let navItem = document.getElementById("navItem");

const cambiarItem = () => {
  var tamañoPantalla = window.innerWidth;

  if (tamañoPantalla >= 576 && tamañoPantalla <= 769) {
    btnItem.style.paddingBottom = "2px";
    item1.style.marginLeft = "50px";
    item1.style.display = "flex";
    item1.style.alignItems = "center";
    item2.style.display = "flex";
    item1.style.alignItems = "center";
    item3.style.display = "flex";
    item1.style.alignItems = "center";
    item1.style.paddingBottom="0px"
    item2.style.paddingBottom="0px"
    item3.style.paddingBottom="0px"
    item2.style.alignItems = "center";
    item3.style.alignItems = "center";
    item2.style.marginLeft = "50px";
    item3.style.marginLeft = "50px";
   

    item4.style.display = "flex";
    item4.style.alignItems = "center";
    item4.style.paddingBottom="0px"
    item4.style.marginLeft = "50px";
  } 
  else if (tamañoPantalla >= 770){
    item1.style.paddingBottom="30px"
    item2.style.paddingBottom="30px"
    item3.style.paddingBottom="30px"
    item4.style.paddingBottom="30px"
    item1.style.display = "";
    item2.style.display = "";
    item3.style.display = "";
    item4.style.display = "";
  }
  if(tamañoPantalla >= 770 && tamañoPantalla <= 1050)
  {
    navItem.style.paddingLeft="0px"
  }
  else if(tamañoPantalla >= 1051)
  {
    navItem.style.paddingLeft="15px"
  }
};

// Asigna la función, no la llamada a la función
window.onload = cambiarItem;

// Asigna la función al evento onresize
window.onresize = cambiarItem;

//aca hago la funcion donde al darle clic lo mande para el formulario de usuarios
item1.addEventListener("click", () => {
  location.href = "frmUsuarios.php";
});



//aca voy hacer la funcion que se ejecutara cuando el usuario se va salir de su cuenta

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


<script src="./isset/js/mainProductos.js"></script>
<script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>




