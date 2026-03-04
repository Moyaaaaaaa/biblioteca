<h2>Mis Devoluciones</h2>

<table border="1">

<tr>
    <th>Libro</th>
    <th>Fecha Devolución</th>
    <th>Estado</th>
</tr>

<?php foreach($data['devoluciones'] as $d): ?>

<tr>

<td><?= $d['titulo'] ?></td>

<td><?= $d['fecha_devolucion'] ?></td>

<td>

<?php if($d['dias_retraso'] > 0): ?>

Devolución tardía (<?= $d['dias_retraso'] ?> días)

<?php else: ?>

Devuelto a tiempo

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="<?= BASE_URL ?>DashboardController/index">
Volver
</a>