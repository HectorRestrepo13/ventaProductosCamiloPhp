<?php
ob_start();

//-----------------------------------------------
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
    <title>Document</title>
</head>
<body>
    
<div class="container-fluid">
    <div class="row">
        <!-- aca voy a poner donde va ir la tabla de los productos -->
        <div  style=" padding: 0px;" class="col-sm-12 col-md-10 col-lg-10 col-xl-10">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th  width="100">Imagen</th>
                        <th  width="100">ID</th>
                        <th  width="100">Nombre</th>
                        <th  width="100">Cantidad</th>
                        <th  width="100">Usuario</th>
                        <th  width="100"></th>
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
                                    echo '<td  width="100"><img style="height: 80px;  width: 80px;  border-radius: 30px;" src="./imagenes/'.$fila[3].'" alt="" srcset="./imagenes/'.$fila[3].'"></td>';
                                } else {
                                    // El archivo no existe, puedes mostrar una imagen predeterminada o algún mensaje de error
                                    echo '<td  width="100"><img src="ruta/a/tu/carpeta/imagen_predeterminada.jpg" alt="Imagen no encontrada"></td>';
                                }
                                ?>
                                <td  width="100"><?php echo $fila[0]?></td>
                                <td  width="100"><?php echo $fila[1]?></td>
                                <td  width="100"><?php echo $fila[2]?></td>
                                <td  width="100"><?php echo $fila[4]?></td>
                                <!-- aca voy a poner el boton donde va poner las opciones de editar o eliminar -->
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Detalle
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Ver</a></li>
                                            <li><a class="dropdown-item" href="#"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: transparent;color: black; border: none;" data-bs-whatever="@mdo" onclick="idProductoEditar('<?php echo $fila[0] ?>')">Editar</button></a></li>
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
                    <!-- aca voy a colocar el modal que se desplegará cuando le unda editar para que ingrese los datos a cambiar-->
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
                </div>
            </div>
        </div>
    </body>
    </html>

<?php
$html = ob_get_clean();

require_once 'isset/libreria/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Crear una instancia de Dompdf
$dompdf = new Dompdf();

// Configurar opciones
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf->setOptions($options);

// Cargar el contenido HTML
$dompdf->loadHtml("hola");

// (Opcional) Configurar el tamaño del papel y la orientación
$dompdf->setPaper('A4', 'portrait');

// Renderizar el PDF
$dompdf->render();

// (Opcional) Enviar el PDF al navegador
$dompdf->stream('documento.pdf', array('Attachment' => 0));
?>