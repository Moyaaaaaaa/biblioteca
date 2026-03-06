<h2>Crear Usuario</h2>

<form method="POST" action="<?= BASE_URL ?>UsuarioController/guardar">

<label>Nombre</label>
<br>
<input type="text" name="nombre" required>

<br><br>

<label>Apellido paterno</label>
<br>
<input type="text" name="apellido_paterno" required>

<br><br>

<label>Apellido materno</label>
<br>
<input type="text" name="apellido_materno">

<br><br>

<label>Username</label>
<br>
<input type="text" name="username" required>

<br><br>

<label>Correo</label>
<br>
<input type="email" name="correo" required>

<br><br>

<label>Contraseña</label>
<br>
<input type="password" name="contrasenia" required>

<br><br>

<label>Fecha de nacimiento</label>
<br>
<input type="date" name="fecha_nacimiento" required>

<br><br>

<label>Rol</label>
<br>

<select name="id_rol" required>

<?php foreach($data['roles'] as $rol): ?>

<option value="<?= $rol['id_rol'] ?>">
<?= $rol['nombre_rol'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit">
Crear usuario
</button>

</form>

<br>

<?php if($_SESSION['usuario']['id_rol'] == 1): ?>

<a href="<?= BASE_URL ?>AdminController/index">
Volver
</a>

<?php else: ?>

<a href="<?= BASE_URL ?>BibliotecarioController/index">
Volver
</a>

<?php endif; ?>