<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="./isset/css/styleRegistro.css">-->
    <title>Registro de usuarios</title>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-4">Registrarse</h2>
                    <form action="registro.php" method="post" enctype="multipart/form-data">
                        <!-- Name input -->
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Nombre</label>
                            <input name="nombre" type="text" id="registerName" class="form-control" />
                        </div>

                        <!-- Username input -->
                        <div class="mb-3">
                            <label for="registerUsername" class="form-label">Usuario o alias</label>
                            <input name="usuario" type="text" id="registerUsername" class="form-control" />
                        </div>

                        <!-- Email input -->
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email</label>
                            <input name="correo" type="email" id="registerEmail" class="form-control" />
                        </div>

                        <!-- Password input -->
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Contraseña</label>
                            <input name="contra" type="password" id="registerPassword" class="form-control" />
                        </div>

                        <!-- Repeat Password input -->
                        <div class="mb-3">
                            <label for="registerRepeatPassword" class="form-label">Repita la contraseña</label>
                            <input type="password" id="registerRepeatPassword" class="form-control" />
                        </div>
  <!-- input de file imagen-->
  <div class="mb-3">
                            
                            <input type="file" name="imagenUsuario" placeholder="Ingrese la imagen" class="form-control" />
                        </div>
                        <!-- Checkbox -->
                        <div class="mb-3 form-check d-flex justify-content-center">
                            <input
                                class="form-check-input me-2"
                                type="checkbox"
                                value=""
                                id="registerCheck"
                                checked
                                aria-describedby="registerCheckHelpText"
                            />
                            <label class="form-check-label" for="registerCheck">
                                He leído y acepto los términos.
                            </label>
                        </div>

                        <!-- Submit button -->
                        <button data-mdb-ripple-init class="btn btn-primary btn-block mb-3 btn-lg" type="padding-left: 2.5rem; padding-right: 2.5rem;">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
    // Initialization for MDB UI Kit
    import { Input, Ripple, initMDB } from "mdb-ui-kit";
    initMDB({ Input, Ripple });
</script>

</body>
</html>
