<h2>Gestión de Libros</h2>

<a href="<?= BASE_URL ?>BibliotecarioLibroController/crear">
Agregar Libro
</a>

<br><br>

<table border="1">

<tr>
<th>ID</th>
<th>Título</th>
<th>ISBN</th>
<th>Año</th>
<th>Categoría</th>
<th>Ejemplares</th>
<th>Acciones</th>
</tr>

<?php foreach($data['libros'] as $libro): ?>

<tr>

<td><?= $libro['id_libro'] ?></td>
<td><?= $libro['titulo'] ?></td>
<td><?= $libro['isbn'] ?></td>
<td><?= $libro['anio_publicacion'] ?></td>
<td><?= $libro['categoria'] ?></td>
<td><?= $libro['ejemplares'] ?></td>

<td>

<a href="<?= BASE_URL ?>BibliotecarioLibroController/editar/<?= $libro['id_libro'] ?>">
Editar
</a>

|

<a href="<?= BASE_URL ?>BibliotecarioLibroController/eliminar/<?= $libro['id_libro'] ?>">
Eliminar
</a>

|

<a href="<?= BASE_URL ?>BibliotecarioEjemplarController/crear/<?= $libro['id_libro'] ?>">
Agregar ejemplar
</a>

</td>

</tr>

<?php endforeach; ?>

</table>