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


    <li>
        <a href="<?= BASE_URL ?>AutorController/index">
            Autores
        </a>
    </li>

    <li>
        <a href="<?= BASE_URL ?>LibroController/catalogo">
            Libros
        </a>
    </li>

    <li>
        <a href="<?= BASE_URL ?>PrestamoController/misPrestamos">
            Préstamos
        </a>
    </li>

    <li>
        <a href="<?= BASE_URL ?>DevolucionController/misDevoluciones">
            Devoluciones
        </a>
    </li>

    <li>
        <a href="<?= BASE_URL ?>MultaController/misMultas">
            Multas
        </a>
    </li>

    <li><a href="<?= BASE_URL ?>NotificacionController/index">Notificaciones</a></li>