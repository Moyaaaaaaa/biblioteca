<h1>Biblioteca</h1>

<p>

Bienvenido:

<?= $_SESSION['usuario']['nombre'] ?>

</p>

<br>

<a href="<?= BASE_URL ?>AuthController/logout">

Cerrar sesión

</a>

<h3>Menú</h3>

<ul>

<li><a href="#">Usuarios</a></li>

<li><a href="#">Autores</a></li>

<li><a href="#">Libros</a></li>

<li><a href="#">Préstamos</a></li>

<li><a href="#">Devoluciones</a></li>

</ul>