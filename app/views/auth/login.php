<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

</head>

<body>

    <h2>Login Biblioteca</h2>

    <form action="<?php echo BASE_URL; ?>AuthController/autenticar" method="POST">

        <label>Usuario</label>

        <input type="text" name="username" required>

        <br><br>

        <label>Contraseña</label>

        <input type="password" name="contrasenia" required>

        <br><br>

        <button type="submit">

            Iniciar Sesión

        </button>

    </form>

    <br>

    <a href="<?= BASE_URL ?>AuthController/registro">

        Crear usuario

    </a>

</body>

</html>