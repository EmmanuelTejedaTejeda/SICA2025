<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Edgar Degante Aguilar">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Asesorías</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dash.css') ?>">

</head>

<body class="d-flex flex-column h-100">
    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container text-center">

            <h3 class="mt-5">INSTITUTO TECNOLÓGICO SUPERIOR DE TEZIUTLÁN</h3>
            <h1 class="mt-1">Sistema de Gestión de Asesorías Académicas</h1>

            <img src="<?php echo base_url(''); ?>" alt="">
        </div>
    </main>

    <article class="container">

        <div class="text-center mb-3">
            <h2>Formulario de registro</h2>
        </div>



        <div>
            <form class="" action="<?= base_url('/registro') ?>" method="post" enctype="multipart/form-data">

                <div class="card-body">
                    <h4>Datos personales</h4>


                    <?php csrf_field(); ?>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputBorderWidth2">Nombre:</label>
                                <input type="text" class="form-control" required id="exampleInputBorderWidth2"
                                    name="nombre" placeholder="Ejemplo: Edgar">
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputBorderWidth2">Apellido Paterno:</label>
                                <input type="text" class="form-control" required id="exampleInputBorderWidth2"
                                    name="apaterno" placeholder="Ejemplo: Degante">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="exampleInputBorderWidth2">Apellido Materno:</label>
                                <input type="text" class="form-control" required id="exampleInputBorderWidth2"
                                    name="amaterno" placeholder="Ejemplo: Aguilar" minlength="3">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rfc">RFC:</label>
                                <input type="text" class="form-control" required id="exampleInputBorderWidth2"
                                    name="rfc" minlength="13" maxlength="13" required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Sexo:</label>
                                <select class="form-control" name="sexo" id="">
                                    <option value="f">Femenino</option>
                                    <option value="m">Masculino</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Fecha de nacimiento:</label>
                                <input type="date" class="form-control" required id="exampleInputBorderWidth2"
                                    name="fechaNacimiento">
                            </div>
                        </div>

                    </div>


                    <h4 class="mt-5">Datos para inicio de sesión</h4>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Nombre de usuario:</label>
                                <input type="text" class="form-control" required id="exampleInputBorderWidth2"
                                    name="username" placeholder="miusuario" minlength="5" maxlength="15">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Contraseña:</label>
                                <input type="password" class="form-control" required id="exampleInputBorderWidth2"
                                    name="password" minlength="8" maxlength="20" placeholder="Defina una contraseña" aria-describedby="passwordHelpBlock">
                                    <div class="col-auto">
                                        <span id="passwordHelpInline" class="form-text">
                                        Su contraseña debe tener entre 8 y 30 caracteres.
                                        </span>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputBorderWidth2">Correo electrónico:</label>
                                <input type="email" class="form-control" required id="exampleInputBorderWidth2"
                                    name="email" placeholder="usuario@mail.com">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5">
                        <button type="reset" class="btn btn-default me-md-2">Restablecer campos</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>

                </div>

            </form>
        </div>



    </article>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">Developed by edegantea for ITST. 2024.</span>
        </div>
    </footer>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.4/jquery.inputmask.min.js"></script>

    <script>
    // Agregar la máscara al campo de entrada de teléfono
    $(document).ready(function() {
        $('#telefono').inputmask('(999) 999-9999');
    });
    </script>


    <script>
    // Agregar la máscara al campo de entrada de CURP
    $(document).ready(function() {
        $('#curp').inputmask('aaaA999999HAA999AA9', {
            placeholder: " "
        });
    });
    </script>

</body>

</html>