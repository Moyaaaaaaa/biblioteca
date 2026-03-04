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

<label>Autores</label>
<br>

<select name="autores[]" multiple size="5">

<?php foreach($data['autores'] as $autor): ?>

<option value="<?= $autor['id_autor'] ?>">
<?= $autor['nombre'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit">
Guardar Libro
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioLibroController/index">
Volver
</a>