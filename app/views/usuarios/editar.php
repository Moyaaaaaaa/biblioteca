<h2>Editar Usuario</h2>

<form method="POST" action="<?= BASE_URL ?>UsuarioController/actualizar">

<input type="hidden" 
name="id_usuario" 
value="<?= $data['usuario']['id_usuario'] ?>">

<label>Nombre</label>
<br>
<input type="text" 
name="nombre"
value="<?= $data['usuario']['nombre'] ?>"
required>

<br><br>

<label>Apellido paterno</label>
<br>
<input type="text"
name="apellido_paterno"
value="<?= $data['usuario']['apellido_paterno'] ?>"
required>

<br><br>

<label>Apellido materno</label>
<br>
<input type="text"
name="apellido_materno"
value="<?= $data['usuario']['apellido_materno'] ?>">

<br><br>

<label>Username</label>
<br>
<input type="text"
name="username"
value="<?= $data['usuario']['username'] ?>"
required>

<br><br>

<label>Correo</label>
<br>
<input type="email"
name="correo"
value="<?= $data['usuario']['correo'] ?>"
required>

<br><br>

<label>Rol</label>
<br>

<select name="id_rol">

<?php foreach($data['roles'] as $rol): ?>

<option 
value="<?= $rol['id_rol'] ?>"
<?= $rol['id_rol'] == $data['usuario']['id_rol'] ? 'selected' : '' ?>>

<?= $rol['nombre_rol'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit">
Actualizar usuario
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