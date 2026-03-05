<h2>Autores</h2>

<table border="1">

<tr>
<th>Nombre</th>
<th>Apellido paterno</th>
<th>Apellido materno</th>
<th>Nacionalidad</th>
<th>Acción</th>
</tr>

<?php foreach($data['autores'] as $autor): ?>

<tr>

<td><?= $autor['nombre'] ?></td>

<td><?= $autor['apellido_paterno'] ?></td>

<td><?= $autor['apellido_materno'] ?></td>

<td><?= $autor['nacionalidad'] ?></td>

<td>

<a href="<?= BASE_URL ?>AutorController/libros/<?= $autor['id_autor'] ?>">
Ver libros
</a>

</td>

</tr>

<?php endforeach; ?>

</table>