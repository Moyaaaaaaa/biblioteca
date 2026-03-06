<h2>Usuarios</h2>

<br>

<a href="<?= BASE_URL ?>UsuarioController/crear">
Crear usuario
</a>

<br><br>

<table border="1">

<tr>

<th>Nombre</th>
<th>Username</th>
<th>Correo</th>
<th>Rol</th>
<th>Acciones</th>

</tr>

<?php foreach($data['usuarios'] as $u): ?>

<tr>

<td>
<?= $u['nombre'] ?> <?= $u['apellido_paterno'] ?>
</td>

<td><?= $u['username'] ?></td>

<td><?= $u['correo'] ?></td>

<td><?= $u['nombre_rol'] ?></td>

<td>

<a href="<?= BASE_URL ?>UsuarioController/editar/<?= $u['id_usuario'] ?>">
Editar
</a>

<?php if($_SESSION['usuario']['id_rol'] == 1): ?>

|

<a href="<?= BASE_URL ?>UsuarioController/eliminar/<?= $u['id_usuario'] ?>"
onclick="return confirm('¿Eliminar este usuario?')">
Eliminar
</a>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</table>

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