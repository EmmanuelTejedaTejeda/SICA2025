<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>

	<!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">	-->

	
<style {csp-style-nonce}>

	/* Estilos generales para centrar en pantalla */
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    margin: 0;
    margin: 0;
    padding: 0;
    /* background-image: url(<?php echo base_url('assets/img/upnfoto1.jpg'); ?>); */
    background-color: #23468c;
    background-size: cover;
    background-position: center;
    background-attachment: fixed; /* Opcional: mantiene la imagen fija al desplazarse */
    background-repeat: no-repeat;
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

</style>


</head>

<body class="text-center">
    <div class="login-container">
        <h2>Acceso</h2>
        <form action="<?= base_url('login'); ?>" method="post">
            <div class="input-container">
                <label for="identificador">Número de huella:</label>
                <input type="text" id="identificador" name="identificador" required>
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>


        <br>
        <br>

        <a href="<?php echo base_url('registro'); ?>">Registrarme</a>


    </div>


    

</body>

</html>
