<h2>Crear Usuario</h2>

<form action="<?= BASE_URL ?>AuthController/guardarUsuario" method="POST">

Nombre:

<input type="text" name="nombre" required>

<br><br>

Apellido paterno:

<input type="text" name="apellido_paterno" required>

<br><br>

Apellido materno:

<input type="text" name="apellido_materno">

<br><br>

Username:

<input type="text" name="username" required>

<br><br>

Correo:

<input type="email" name="correo" required>

<br><br>

Fecha nacimiento:

<input type="date" name="fecha_nacimiento" required>

<br><br>

Contraseña:

<input type="password" name="contrasenia" required>

<br><br>

Rol:

<select name="id_rol" required>

<?php foreach($data as $rol): ?>

<option value="<?= $rol['id_rol'] ?>">

<?= $rol['nombre_rol'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit">

Crear Usuario

</button>

</form>

<br>

<a href="<?= BASE_URL ?>AuthController/login">

Volver Login

</a>