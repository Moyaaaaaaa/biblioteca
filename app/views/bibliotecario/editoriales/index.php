<h2>Gestión de Editoriales</h2>

<a href="<?= BASE_URL ?>BibliotecarioEditorialController/crear">
Agregar Editorial
</a>

<br><br>

<table border="1">

<tr>
<th>ID</th>
<th>Editorial</th>
<th>Acciones</th>
</tr>

<?php foreach($data['editoriales'] as $e): ?>

<tr>

<td><?= $e['id_editorial'] ?></td>

<td><?= $e['editorial'] ?></td>

<td>

<a href="<?= BASE_URL ?>BibliotecarioEditorialController/editar/<?= $e['id_editorial'] ?>">
Editar
</a>

|

<a href="<?= BASE_URL ?>BibliotecarioEditorialController/eliminar/<?= $e['id_editorial'] ?>">
Eliminar
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="<?= BASE_URL ?>BibliotecarioController/index">
Volver
</a>