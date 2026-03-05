<h2>Agregar Editorial</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioEditorialController/guardar">

<label>Nombre editorial</label>

<br>

<input type="text" name="editorial" required>

<br><br>

<button type="submit">
Guardar
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioEditorialController/index">
Volver
</a>