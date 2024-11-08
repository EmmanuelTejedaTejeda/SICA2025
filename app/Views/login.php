<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <style {csp-style-nonce}>
        /* Estilos generales para centrar en pantalla */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            margin: 0;
            padding: 0;
            /* background-image: url(<?php echo base_url('assets/img/upnfoto1.jpg'); ?>); */
            background-color: #10312B;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* Opcional: mantiene la imagen fija al desplazarse */
            background-repeat: no-repeat;
            font-family: 'Montserrat', sans-serif;
            opacity: 1;
            overflow-y: scroll;
            margin: 0;

        }




        /* Estilos específicos para el formulario */
        .login-container {
            width: 300px;
            padding: 20px;
            border: 1px solid rgba(200, 200, 200, 1);
            background-color: rgba(200, 200, 200, 1);
            border-radius: 5px;
            text-align: center;
        }

        .input-container {
            margin: 10px 0;
            text-align: left;
        }

        label {
            display: block;
        }

        input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .enlace {
            padding-top: 20px;
        }
    </style>


</head>

<body class="text-center">
    <div class="login-container">
        <h2>SICAC</h2>
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger text-danger-emphasis bg-danger-subtle" role="alert">
                <?= session('error') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('success')): ?>
            <div class="alert alert-danger text-danger-emphasis bg-danger-subtle" role="alert">
                <?= session('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->has('message')): ?>
            <div class="alert alert alert-primary text-primary-emphasis bg-danger-subtle" role="alert">
                <?= session('message') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login'); ?>" method="post">
            <div class="input-container">
                <label for="identificador">Número de control:</label>
                <input type="text" id="identificador" name="identificador" required>
            </div>
            <div class="input-container">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Iniciar sesión</button>
            
        </form>

        
        <div class="mt-2">
                <a class="text-dark" href="<?php echo base_url('registro'); ?>">Registrarme</a>
        </div>
        

    </div>






</body>


</html>