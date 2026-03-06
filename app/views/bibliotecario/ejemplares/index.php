<h2>Gestión de Ejemplares</h2>

<a href="<?= BASE_URL ?>BibliotecarioEjemplarController/crear">
Agregar Ejemplar
</a>

<table border="1">

<tr>
<th>ID</th>
<th>Libro</th>
<th>Código etiqueta</th>
<th>Estado</th>
<th>Condición</th>
<th>Acciones</th>
</tr>

<?php foreach($data['ejemplares'] as $e): ?>

<tr>

<td><?= $e['id_ejemplar'] ?></td>

<td><?= $e['titulo'] ?></td>

<td><?= $e['codigo_etiqueta'] ?></td>

<td><?= $e['estado'] ?></td>

<td><?= $e['condicion'] ?></td>

<td>

<a href="<?= BASE_URL ?>BibliotecarioEjemplarController/editar/<?= $e['id_ejemplar'] ?>">
Editar
</a>

<a href="<?= BASE_URL ?>BibliotecarioEjemplarController/eliminar/<?= $e['id_ejemplar'] ?>">
Eliminar
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<?php if($_SESSION['usuario']['id_rol']==1): ?>

<a href="<?= BASE_URL ?>AdminController/index">
Volver
</a>

<?php else: ?>

<a href="<?= BASE_URL ?>BibliotecarioController/index">
Volver
</a>

<?php endif; ?>