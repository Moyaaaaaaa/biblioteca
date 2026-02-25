<h1>Usuarios</h1>

<a href="<?= BASE_URL ?>UsuarioController/create">

Nuevo Usuario

</a>

<table border="1">

<tr>

<th>ID</th>
<th>Usuario</th>
<th>Rol</th>

</tr>

<?php foreach($usuarios as $u): ?>

<tr>

<td><?= $u->id_usuario ?></td>

<td><?= $u->usuario ?></td>

<td><?= $u->nombre_rol ?></td>

</tr>

<?php endforeach; ?>

</table>