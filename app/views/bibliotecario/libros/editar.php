<h2>Editar Libro</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioLibroController/actualizar">

<input type="hidden" name="id_libro" value="<?= $data['libro']['id_libro'] ?>">

<label>Título</label>
<br>
<input type="text" name="titulo" value="<?= $data['libro']['titulo'] ?>" required>
<br><br>

<label>ISBN</label>
<br>
<input type="text" name="isbn" value="<?= $data['libro']['isbn'] ?>" required>
<br><br>

<label>Año publicación</label>
<br>
<input type="number" name="anio_publicacion" value="<?= $data['libro']['anio_publicacion'] ?>" required>
<br><br>

<label>Categoría</label>
<br>
<select name="id_categoria">

<?php foreach($data['categorias'] as $categoria): ?>

<option value="<?= $categoria['id_categoria'] ?>"
<?php if($categoria['id_categoria']==$data['libro']['id_categoria']) echo "selected"; ?>>

<?= $categoria['categoria'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Editorial</label>
<br>
<select name="id_editorial">

<?php foreach($data['editoriales'] as $editorial): ?>

<option value="<?= $editorial['id_editorial'] ?>"
<?php if($editorial['id_editorial']==$data['libro']['id_editorial']) echo "selected"; ?>>

<?= $editorial['editorial'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Autores</label>
<br><br>

<div style="border:1px solid #ccc;padding:10px;width:300px;max-height:150px;overflow:auto;">

<?php foreach($data['autores'] as $autor): ?>

<label>

<input type="checkbox"
name="autores[]"
value="<?= $autor['id_autor'] ?>"

<?php if(in_array($autor['id_autor'],$data['autoresLibro'])) echo "checked"; ?>

>

<?= $autor['nombre'] ?>

</label>

<br>

<?php endforeach; ?>

</div>

<br>

<button type="submit">
Actualizar Libro
</button>

</form>