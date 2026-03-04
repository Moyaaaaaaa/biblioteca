<h2>Mis Multas</h2>

<table border="1">

<tr>
<th>Libro</th>
<th>Motivo</th>
<th>Monto</th>
<th>Estado</th>
</tr>

<?php foreach($data['multas'] as $m): ?>

<tr>

<td><?= $m['titulo'] ?></td>

<td><?= $m['motivos'] ?></td>

<td>$<?= $m['monto_total'] ?></td>

<td>

<?php
if($m['pagada']==0){
echo "Pendiente";
}else{
echo "Pagada";
}
?>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<a href="<?= BASE_URL ?>DashboardController/index">
Volver
</a>