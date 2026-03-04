<h2>Préstamos Activos</h2>

<table border="1">

<tr>
<th>Usuario</th>
<th>Libro</th>
<th>Código Ejemplar</th>
<th>Fecha Préstamo</th>
<th>Fecha Límite</th>
<th>Condición Actual</th>
<th>Acción</th>
</tr>

<?php foreach($data['prestamos'] as $p): ?>

<tr>

<td><?= $p['nombre'] ?></td>

<td><?= $p['titulo'] ?></td>

<td><?= $p['codigo_etiqueta'] ?></td>

<td><?= $p['fecha_prestamo'] ?></td>

<td><?= $p['fecha_limite'] ?></td>

<td><?= $p['condicion'] ?></td>

<td>

<a href="<?= BASE_URL ?>BibliotecarioController/devolver/<?= $p['id_prestamo'] ?>">
Registrar devolución
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="<?= BASE_URL ?>BibliotecarioController/index">
Volver
</a>