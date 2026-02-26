<h1>Panel Administrador Biblioteca</h1>

<p>

Bienvenido:

<?= $_SESSION['usuario']['nombre']; ?>

</p>

<hr>

<h3>Administración</h3>

<ul>

<li>

<a href="<?= BASE_URL ?>UsuarioController">

CRUD Usuarios

</a>

</li>


<li>

<a href="<?= BASE_URL ?>LibroController">

CRUD Libros

</a>

</li>


<li>

<a href="<?= BASE_URL ?>AutorController">

CRUD Autores

</a>

</li>


<li>

<a href="<?= BASE_URL ?>PrestamoController">

Préstamos

</a>

</li>


<li>

<a href="<?= BASE_URL ?>MultaController">

Multas (Ver / Eliminar)

</a>

</li>

</ul>

<hr>

<a href="<?= BASE_URL ?>AuthController/logout">

Cerrar Sesión

</a>

<a href="<?=BASE_URL?>UsuarioController/index">

Administrar Usuarios

</a>