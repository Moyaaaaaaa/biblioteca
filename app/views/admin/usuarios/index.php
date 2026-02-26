<h2>Usuarios</h2>

<table border="1">

<tr>

<th>Nombre</th>
<th>Username</th>
<th>Correo</th>
<th>Rol</th>
<th>Acciones</th>

</tr>

<?php foreach($data as $u): ?>

<tr>

<td>

<?= $u['nombre'] ?>

<?= $u['apellido_paterno'] ?>

</td>

<td><?= $u['username'] ?></td>

<td><?= $u['correo'] ?></td>

<td><?= $u['nombre_rol'] ?></td>

<td>

<a href="<?=BASE_URL?>UsuarioController/editar/<?= $u['id_usuario']?>">

Editar

</a>

|

<a href="<?=BASE_URL?>UsuarioController/eliminar/<?= $u['id_usuario']?>">

Eliminar

</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="<?=BASE_URL?>AdminController/index">

Volver

</a>