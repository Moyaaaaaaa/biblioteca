<h2>Gestión de Categorías</h2>

<a href="<?= BASE_URL ?>BibliotecarioCategoriaController/crear">
Agregar Categoría
</a>

<br><br>

<table border="1">

<tr>
<th>ID</th>
<th>Categoría</th>
<th>Acciones</th>
</tr>

<?php foreach($data['categorias'] as $categoria): ?>

<tr>

<td><?= $categoria['id_categoria'] ?></td>

<td><?= $categoria['categoria'] ?></td>

<td>

<a href="<?= BASE_URL ?>BibliotecarioCategoriaController/editar/<?= $categoria['id_categoria'] ?>">
Editar
</a>

|

<a href="<?= BASE_URL ?>BibliotecarioCategoriaController/eliminar/<?= $categoria['id_categoria'] ?>">
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