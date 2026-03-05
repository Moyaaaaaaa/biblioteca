<h2>Agregar Categoría</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioCategoriaController/guardar">

<label>Nombre de categoría</label>
<br>

<input type="text" name="categoria" required>

<br><br>

<button type="submit">
Guardar Categoría
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioCategoriaController/index">
Volver
</a>