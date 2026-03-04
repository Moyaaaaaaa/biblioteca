<h1>Panel Bibliotecario</h1>

<p>Bienvenido: <?= $_SESSION['usuario']['nombre'] ?></p>

<br>

<a href="<?= BASE_URL ?>BibliotecarioController/prestamosActivos">
    Ver Préstamos Activos
</a>

<br><br>

<a href="<?= BASE_URL ?>AuthController/logout">
    Cerrar sesión
</a>

<a href="<?= BASE_URL ?>MultaController/index">
Panel de multas
</a>