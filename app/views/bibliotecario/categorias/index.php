<h2>Gestión de Categorías</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Categoría</th>
<th>Acciones</th>
</tr>

<?php foreach($data['categorias'] as $c): ?>

<tr>

<td><?= $c['id_categoria'] ?></td>

<td><?= $c['categoria'] ?></td>

<td>

<a href="<?= BASE_URL ?>BibliotecarioCategoriaController/editar/<?= $c['id_categoria'] ?>">
Editar
</a>

<a href="<?= BASE_URL ?>BibliotecarioCategoriaController/eliminar/<?= $c['id_categoria'] ?>">
Eliminar
</a>

</td>

</tr>

<?php endforeach; ?>

</table>