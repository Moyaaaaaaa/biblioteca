<h2>Agregar Ejemplar</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioEjemplarController/guardar">

<label>Libro</label>
<br>

<select name="id_libro" required>

<?php foreach($data['libros'] as $libro): ?>

<option value="<?= $libro['id_libro'] ?>">
<?= $libro['titulo'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Código etiqueta</label>
<br>

<input type="text" name="codigo_etiqueta" required>

<br><br>

<label>Estado</label>
<br>

<select name="id_estado">

<?php foreach($data['estados'] as $estado): ?>

<option value="<?= $estado['id_estado'] ?>">
<?= $estado['estado'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Condición</label>
<br>

<select name="id_condicion">

<?php foreach($data['condiciones'] as $condicion): ?>

<option value="<?= $condicion['id_condicion'] ?>">
<?= $condicion['condicion'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit">
Guardar Ejemplar
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioEjemplarController/index">
Volver
</a>