<h2>Mis Devoluciones</h2>

<table border="1">

<tr>
<th>Libro</th>
<th>Código Ejemplar</th>
<th>Fecha préstamo</th>
<th>Fecha devolución</th>
<th>Días retraso</th>
<th>Condición devuelta</th>
<th>Multa</th>
</tr>

<?php foreach($data['devoluciones'] as $d): ?>

<tr>

<td><?= $d['titulo'] ?></td>

<td><?= $d['codigo_etiqueta'] ?></td>

<td><?= $d['fecha_prestamo'] ?></td>

<td><?= $d['fecha_devolucion'] ?></td>

<td>

<?php
if($d['dias_retraso'] > 0){
echo "Retraso de ".$d['dias_retraso']." días";
}else{
echo "Sin retraso";
}
?>

</td>

<td><?= $d['condicion'] ?></td>

<td>

<?php
if($d['monto_total']){
echo "$".$d['monto_total'];
}else{
echo "Sin multa";
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