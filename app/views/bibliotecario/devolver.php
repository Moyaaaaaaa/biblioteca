<h2>Registrar devolución</h2>

<p><b>Libro:</b> <?= $data['prestamo']['titulo'] ?></p>

<p><b>Ejemplar:</b> <?= $data['prestamo']['codigo_etiqueta'] ?></p>

<p><b>Condición al prestar:</b> <?= $data['prestamo']['condicion'] ?></p>

<p><b>Fecha límite:</b> <?= $data['prestamo']['fecha_limite'] ?></p>

<form method="POST" action="<?= BASE_URL ?>DevolucionController/devolver">

<input type="hidden" name="id_prestamo"
value="<?= $data['prestamo']['id_prestamo'] ?>">

<label>Condición al devolver</label>

<select name="condicion_devuelta">

<?php foreach($data['condiciones'] as $c): ?>

<option value="<?= $c['id_condicion'] ?>">
<?= $c['condicion'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit">
Registrar devolución
</button>

</form>