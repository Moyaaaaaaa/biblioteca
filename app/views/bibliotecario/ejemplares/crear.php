<h2>Agregar Ejemplar</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioEjemplarController/guardar">

<?php if(!$data['id_libro']): ?>

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

<?php else: ?>

<h3>Libro</h3>

<strong>
<?= $data['libro']['titulo'] ?>
</strong>

<input type="hidden" name="id_libro" value="<?= $data['id_libro'] ?>">

<br><br>

<?php endif; ?>


<label>Edición</label>
<br>
<input type="text" name="edicion" required>

<br><br>


<label>Año de edición</label>
<br>
<input type="number" name="anio_edicion" required>

<br><br>


<label>Condición</label>
<br>

<select name="id_condicion" required>

<?php foreach($data['condiciones'] as $condicion): ?>

<option value="<?= $condicion['id_condicion'] ?>">
<?= $condicion['condicion'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>


<label>Ubicación física</label>
<br>

<select name="id_ubicacion" required>

<?php foreach($data['ubicaciones'] as $ubicacion): ?>

<option value="<?= $ubicacion['id_ubicacion'] ?>">
<?= $ubicacion['ubicacion'] ?>
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