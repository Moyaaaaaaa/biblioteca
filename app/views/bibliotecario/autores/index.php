<h2>Gestión de Autores</h2>

<a href="<?= BASE_URL ?>BibliotecarioAutorController/crear">
Agregar Autor
</a>

<br><br>

<table border="1">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Apellido paterno</th>
<th>Apellido materno</th>
<th>Nacionalidad</th>
<th>Acciones</th>
</tr>

<?php foreach($data['autores'] as $autor): ?>

<tr>

<td><?= $autor['id_autor'] ?></td>

<td><?= $autor['nombre'] ?></td>

<td><?= $autor['apellido_paterno'] ?></td>

<td><?= $autor['apellido_materno'] ?></td>

<td><?= $autor['nacionalidad'] ?></td>

<td>

<a href="<?= BASE_URL ?>BibliotecarioAutorController/editar/<?= $autor['id_autor'] ?>">
Editar
</a>

|

<a href="<?= BASE_URL ?>BibliotecarioAutorController/eliminar/<?= $autor['id_autor'] ?>">
Eliminar
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<?php if($_SESSION['usuario']['id_rol']==1): ?>

<a href="<?= BASE_URL ?>AdminController/index">
Volver
</a>

<?php else: ?>

<a href="<?= BASE_URL ?>BibliotecarioController/index">
Volver
</a>

<?php endif; ?>