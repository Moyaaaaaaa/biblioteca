<h2>Editar Categoría</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioCategoriaController/actualizar">

<input type="hidden" name="id_categoria" value="<?= $data['categoria']['id_categoria'] ?>">

<label>Categoría</label>
<br>

<input type="text" name="categoria" value="<?= $data['categoria']['categoria'] ?>" required>

<br><br>

<button type="submit">
Actualizar Categoría
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioCategoriaController/index">
Volver
</a>