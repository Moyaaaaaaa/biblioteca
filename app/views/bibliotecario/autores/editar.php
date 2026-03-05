<h2>Editar Autor</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioAutorController/actualizar">

<input type="hidden" name="id_autor" value="<?= $data['autor']['id_autor'] ?>">

<label>Nombre</label>
<br>
<input type="text" name="nombre" value="<?= $data['autor']['nombre'] ?>" required>

<br><br>

<label>Apellido paterno</label>
<br>
<input type="text" name="apellido_paterno" value="<?= $data['autor']['apellido_paterno'] ?>" required>

<br><br>

<label>Apellido materno</label>
<br>
<input type="text" name="apellido_materno" value="<?= $data['autor']['apellido_materno'] ?>">

<br><br>

<label>Nacionalidad</label>
<br>
<input type="text" name="nacionalidad" value="<?= $data['autor']['nacionalidad'] ?>" required>

<br><br>

<button type="submit">
Actualizar Autor
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioAutorController/index">
Volver
</a>