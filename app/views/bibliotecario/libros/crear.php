<h2>Agregar Libro</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioLibroController/guardar">

<label>Título</label>
<br>
<input type="text" name="titulo" required>

<br><br>

<label>ISBN</label>
<br>
<input type="text" name="isbn" required>

<br><br>

<label>Año de publicación</label>
<br>
<input type="number" name="anio_publicacion" required>

<br><br>

<label>Categoría</label>
<br>

<select name="id_categoria" required>

<?php foreach($data['categorias'] as $categoria): ?>

<option value="<?= $categoria['id_categoria'] ?>">
<?= $categoria['categoria'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Editorial</label>
<br>

<select name="id_editorial" required>

<?php foreach($data['editoriales'] as $editorial): ?>

<option value="<?= $editorial['id_editorial'] ?>">
<?= $editorial['editorial'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Autores</label>
<br>
<small>Puede seleccionar uno o varios autores</small>
<br><br>

<div style="border:1px solid #ccc; padding:10px; width:320px; max-height:180px; overflow-y:auto;">

<?php foreach($data['autores'] as $autor): ?>

<label style="display:block; margin-bottom:5px;">

<input type="checkbox" name="autores[]" value="<?= $autor['id_autor'] ?>">

<?= $autor['nombre'] ?>
<?= $autor['apellido_paterno'] ?>
<?= $autor['apellido_materno'] ?>

</label>

<?php endforeach; ?>

</div>

<br>

<button type="submit">
Guardar Libro
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioLibroController/index">
Volver
</a>