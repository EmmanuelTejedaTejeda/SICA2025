<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Edgar Degante Aguilar">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Competencias</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/dash.css') ?>">


    <style {csp-style-nonce}>
        body {
            background-color: #10312B;
            color: #ffffff;
        }

        .text-uppercase {
            text-transform: uppercase;
        }
    </style>

</head>

<body class="d-flex flex-column h-100">
    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container text-center">

            <h3 class="mt-5">INSTITUTO TECNOLÓGICO SUPERIOR DE TEZIUTLÁN</h3>
            <h1 class="mt-1">Sistema de Competencias</h1>

            <img src="<?php echo base_url(''); ?>" alt="">
        </div>
    </main>

    <article class="container">
        <div class="text-center mb-3">
            <h2>Formulario de registro</h2>
        </div>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger text-danger-emphasis bg-danger-subtle" role="alert">
                <?= session('error') ?>
            </div>
        <?php endif; ?>
        <div>
            <form action="<?= base_url('registro') ?>" method="post">
                <h5 class="text-center mt-5">Información básica del usuario</h5>
                <div class="container">
                    <div class="offset-md-3 col-md-6 mb-3">
                        <div class="form-group position-relative">
                            <label class="form-label" for="identificador">Número de control:</label>
                            <input class="text-uppercase form-control" min="8" max="12" required type="text"
                                maxlength="8" id="identificador" name="identificador" oninput="autoGenerateEmail()" placeholder="Escriba su numero de control de 8 digitos">
                        </div>
                    </div>

                    <div class="offset-md-3 col-md-6 mb-3">
                        <div class="form-group position-relative">
                            <label class="form-label" for="email">Correo electrónico institucional:</label>
                            <input class="form-control text-uppercase" required type="email" id="email" name="email"
                                placeholder="El correo se generara automáticamente">
                            <div id="emailAlert" class="alert alert-success position-absolute p-1"
                                style="display: none; top: 0; right: 0; transform: translate(100%, -50%); font-size: 0.8em;">
                                Correo generado automáticamente
                            </div>
                        </div>
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <div class="form-group position-relative">
                            <label class="form-label" for="password">Contraseña:</label>
                            <input id="password" class="form-control" required type="password" name="password" min="8"
                                max="30" placeholder="Escriba una contraseña mayor a 8 digitos">
                            
                        </div>
                    </div>

                </div>


                <h5 class="mt-5 text-center">Datos personales</h5>
                <div class="">
                    <div class="offset-md-3 col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="">Nombre(s):</label>
                            <input class="form-control text-uppercase" required type="text" name="nombre">
                        </div>
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="">Apellido paterno:</label>
                            <input class="form-control text-uppercase" required type="text" name="apaterno">
                        </div>
                    </div>
                    <div class="offset-md-3 col-md-6 mb-3">
                        <div class="form-group">
                            <label class="form-label" for="">Apellido materno:</label>
                            <input class="form-control text-uppercase" required type="text" name="amaterno">
                        </div>
                    </div>
                </div>
                <div class="mb-5 d-grid gap-2 d-md-flex justify-content-md-end">
                    <a type="button" class="btn btn-secondary" href="<?=base_url('login')?>">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>



        </div>



    </article>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            Developed for Ingeniería Informática ITST. <?= date('Y') . '.'; ?>
        </div>
    </footer>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.4/jquery.inputmask.min.js"></script>

    <script>
        // Agregar la máscara al campo de entrada de teléfono
        $(document).ready(function () {
            $('#telefono').inputmask('(999) 999-9999');
        });
    </script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        }
    </script>


    <script>
        // Agregar la máscara al campo de entrada de CURP
        $(document).ready(function () {
            $('#curp').inputmask('aaaA999999HAA999AA9', {
                placeholder: " "
            });
        });
    </script>

    <script>
        function autoGenerateEmail() {
            const controlNumber = document.getElementById("identificador").value;
            const emailInput = document.getElementById("email");
            const emailAlert = document.getElementById("emailAlert");

            // Verifica si el número de control tiene 8 caracteres
            if (controlNumber.length === 8) {
                emailInput.value = `L${controlNumber}@teziutlan.tecnm.mx`;

                // Muestra la alerta por 3 segundos
                emailAlert.style.display = "block";
                setTimeout(() => {
                    emailAlert.style.display = "none";
                }, 3000);
            }
        }

    </script>

</body>

</html>