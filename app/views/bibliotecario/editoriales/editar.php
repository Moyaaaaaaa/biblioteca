<h2>Editar Editorial</h2>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioEditorialController/actualizar">

<input type="hidden"
name="id_editorial"
value="<?= $data['editorial']['id_editorial'] ?>">

<label>Editorial</label>

<br>

<input type="text"
name="editorial"
value="<?= $data['editorial']['editorial'] ?>"
required>

<br><br>

<button type="submit">
Actualizar
</button>

</form>

<br>

<a href="<?= BASE_URL ?>BibliotecarioEditorialController/index">
Volver
</a>