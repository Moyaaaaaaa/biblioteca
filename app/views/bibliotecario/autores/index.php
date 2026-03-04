<h2>Gestión de Autores</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Acciones</th>
</tr>

<?php foreach($data['autores'] as $a): ?>

<tr>

<td><?= $a['id_autor'] ?></td>

<td><?= $a['nombre'] ?></td>

<td>

<a href="<?= BASE_URL ?>BibliotecarioAutorController/editar/<?= $a['id_autor'] ?>">
Editar
</a>

<a href="<?= BASE_URL ?>BibliotecarioAutorController/eliminar/<?= $a['id_autor'] ?>">
Eliminar
</a>

</td>

</tr>

<?php endforeach; ?>

</table>