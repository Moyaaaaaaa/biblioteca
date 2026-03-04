<h2>Categorías disponibles</h2>

<table border="1">

<tr>
<th>Categoría</th>
<th>Ver</th>
</tr>

<?php foreach($data['categorias'] as $c): ?>

<tr>

<td><?= $c['categoria'] ?></td>

<td>

<a href="<?= BASE_URL ?>CategoriaController/ver/<?= $c['id_categoria'] ?>">
Ver libros
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="<?= BASE_URL ?>DashboardController/index">
Volver
</a>