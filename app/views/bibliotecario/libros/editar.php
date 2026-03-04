<h2>Editar Libro</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioLibroController/actualizar">

<input type="hidden" name="id_libro" value="<?= $data['libro']['id_libro'] ?>">

<label>Título</label>
<br>

<input 
type="text" 
name="titulo"
value="<?= $data['libro']['titulo'] ?>"
required>

<br><br>

<label>ISBN</label>
<br>

<input 
type="text"
name="isbn"
value="<?= $data['libro']['isbn'] ?>"
required>

<br><br>

<label>Año de publicación</label>
<br>

<input 
type="number"
name="anio_publicacion"
value="<?= $data['libro']['anio_publicacion'] ?>"
required>

<br><br>

<label>Categoría</label>
<br>

<select name="id_categoria">

<?php foreach($data['categorias'] as $categoria): ?>

<option value="<?= $categoria['id_categoria'] ?>"
<?php if($categoria['id_categoria'] == $data['libro']['id_categoria']) echo "selected"; ?>>

<?= $categoria['categoria'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Autores</label>
<br>

<select name="autores[]" multiple size="5">

<?php foreach($data['autores'] as $autor): ?>

<option value="<?= $autor['id_autor'] ?>"
<?php if(in_array($autor['id_autor'],$data['autores_libro'])) echo "selected"; ?>>

<?= $autor['nombre'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<button type="submit">
Actualizar Libro
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioLibroController/index">
Volver
</a>