<h2>Libros de la categoría</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Título</th>
<th>Categoría</th>
<th>Total ejemplares</th>
<th>Disponibles</th>
<th>Acción</th>
</tr>

<?php foreach($data['libros'] as $libro): ?>

<tr>

<td><?= $libro['id_libro'] ?></td>

<td><?= $libro['titulo'] ?></td>

<td><?= $libro['categoria'] ?></td>

<td><?= $libro['total'] ?></td>

<td><?= $libro['disponibles'] ?></td>

<td>

<?php if($libro['disponibles'] > 0): ?>

<form method="POST" action="<?= BASE_URL ?>PrestamoController/crear">

<input type="hidden" name="id_libro" value="<?= $libro['id_libro'] ?>">

<button type="submit">
Prestar
</button>

</form>

<?php else: ?>

No disponible

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="<?= BASE_URL ?>CategoriaController/index">
Volver a categorías
</a>