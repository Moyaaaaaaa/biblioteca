<h2>Editar Usuario</h2>

<form action="<?=BASE_URL?>UsuarioController/actualizar" method="POST">

<input type="hidden"

name="id_usuario"

value="<?= $data['id_usuario']?>">

Nombre:

<input name="nombre"

value="<?= $data['nombre']?>">

<br><br>

Apellido paterno:

<input name="apellido_paterno"

value="<?= $data['apellido_paterno']?>">

<br><br>

Apellido materno:

<input name="apellido_materno"

value="<?= $data['apellido_materno']?>">

<br><br>

Correo:

<input name="correo"

value="<?= $data['correo']?>">

<br><br>

<button>

Guardar

</button>

</form>