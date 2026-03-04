<h2>Editar Ejemplar</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioEjemplarController/actualizar">

<input type="hidden" name="id_ejemplar" value="<?= $data['ejemplar']['id_ejemplar'] ?>">

<label>Libro</label>
<br>

<select name="id_libro">

<?php foreach($data['libros'] as $libro): ?>

<option value="<?= $libro['id_libro'] ?>"
<?php if($libro['id_libro'] == $data['ejemplar']['id_libro']) echo "selected"; ?>>

<?= $libro['titulo'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Código etiqueta</label>
<br>

<input 
type="text" 
name="codigo_etiqueta"
value="<?= $data['ejemplar']['codigo_etiqueta'] ?>"
required>

<br><br>

<label>Estado</label>
<br>

<select name="id_estado">

<?php foreach($data['estados'] as $estado): ?>

<option value="<?= $estado['id_estado'] ?>"
<?php if($estado['id_estado'] == $data['ejemplar']['id_estado']) echo "selected"; ?>>

<?= $estado['estado'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Condición</label>
<br>

<select name="id_condicion">

<?php foreach($data['condiciones'] as $condicion): ?>

<option value="<?= $condicion['id_condicion'] ?>"
<?php if($condicion['id_condicion'] == $data['ejemplar']['id_condicion']) echo "selected"; ?>>

<?= $condicion['condicion'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit">
Actualizar Ejemplar
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioEjemplarController/index">
Volver
</a>