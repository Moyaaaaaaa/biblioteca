<h2>Gestión de Libros</h2>

<a href="<?= BASE_URL ?>BibliotecarioLibroController/crear">
Agregar Libro
</a>

<table border="1">

<tr>
<th>ID</th>
<th>Título</th>
<th>ISBN</th>
<th>Año</th>
<th>Acciones</th>
</tr>

<?php foreach($data['libros'] as $l): ?>

<tr>

<td><?= $l['id_libro'] ?></td>
<td><?= $l['titulo'] ?></td>
<td><?= $l['isbn'] ?></td>
<td><?= $l['anio_publicacion'] ?></td>

<td>

<a href="<?= BASE_URL ?>BibliotecarioLibroController/editar/<?= $l['id_libro'] ?>">
Editar
</a>

<a href="<?= BASE_URL ?>BibliotecarioLibroController/eliminar/<?= $l['id_libro'] ?>">
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