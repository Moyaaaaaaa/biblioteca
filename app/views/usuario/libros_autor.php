<h2>Libros de <?= $data['autor']['nombre'] ?></h2>

<table border="1">

<tr>
<th>Título</th>
<th>ISBN</th>
<th>Año</th>
<th>Categoría</th>
<th>Total ejemplares</th>
<th>Disponibles</th>
<th>Acción</th>
</tr>

<?php foreach($data['libros'] as $libro): ?>

<tr>

<td><?= $libro['titulo'] ?></td>
<td><?= $libro['isbn'] ?></td>
<td><?= $libro['anio_publicacion'] ?></td>
<td><?= $libro['categoria'] ?></td>
<td><?= $libro['total_ejemplares'] ?></td>
<td><?= $libro['disponibles'] ?></td>

<td>

<?php if($libro['disponibles']>0): ?>

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

<a href="<?= BASE_URL ?>AutorController/index">
Volver a autores
</a>