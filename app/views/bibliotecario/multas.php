<h2>Panel de Multas</h2>

<table border="1">

<tr>
<th>Usuario</th>
<th>Libro</th>
<th>Ejemplar</th>
<th>Motivo</th>
<th>Monto</th>
<th>Estado</th>
<th>Acción</th>
</tr>

<?php foreach($data['multas'] as $m): ?>

<tr>

<td><?= $m['usuario'] ?></td>
<td><?= $m['libro'] ?></td>
<td><?= $m['ejemplar'] ?></td>
<td><?= $m['motivos'] ?? 'Sin motivo' ?></td>

<td>$<?= $m['monto_total'] ?></td>

<td>

<?php if($m['pagada']==0): ?>

Pendiente

<?php else: ?>

Pagada

<?php endif; ?>

</td>

<td>

<?php if($m['pagada']==0): ?>

<form method="POST" action="<?= BASE_URL ?>MultaController/pagar">

<input type="hidden" name="id_multa"
value="<?= $m['id_multa'] ?>">

<button type="submit">
Registrar pago
</button>

</form>

<?php else: ?>

✔

<?php endif; ?>

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