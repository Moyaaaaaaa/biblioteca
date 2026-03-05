<h2>Agregar Autor</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioAutorController/guardar">

<label>Nombre</label>
<br>
<input type="text" name="nombre" required>

<br><br>

<label>Apellido paterno</label>
<br>
<input type="text" name="apellido_paterno" required>

<br><br>

<label>Apellido materno</label>
<br>
<input type="text" name="apellido_materno">

<br><br>

<label>Nacionalidad</label>
<br>
<input type="text" name="nacionalidad">

<br><br>

<button type="submit">
Guardar Autor
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioAutorController/index">
Volver
</a>