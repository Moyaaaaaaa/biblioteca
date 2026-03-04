<h2>Panel de Usuario</h2>

<?php if(!empty($data['multasPendientes'])): ?>

<div style="background:#ffcccc;padding:10px;margin-bottom:20px">

<b>⚠ Tienes multas pendientes.</b><br>

No puedes solicitar nuevos préstamos hasta que el bibliotecario registre el pago.

<br><br>

<a href="<?= BASE_URL ?>MultaController/misMultas">
Ver mis multas
</a>

</div>

<?php endif; ?>

<hr>

<h3>Opciones disponibles</h3>

<ul>

<li>
<a href="<?= BASE_URL ?>LibroController/catalogo">
📚 Ver libros disponibles
</a>
</li>

<li>
<a href="<?= BASE_URL ?>PrestamoController/misPrestamos">
📖 Ver mis préstamos
</a>
</li>

<li>
<a href="<?= BASE_URL ?>DevolucionController/misDevoluciones">
📜 Ver historial de devoluciones
</a>
</li>

<li>
<a href="<?= BASE_URL ?>MultaController/misMultas">
💰 Ver mis multas
</a>
</li>

<li>
<a href="<?= BASE_URL ?>AutorController/index">
✍️ Ver autores
</a>
</li>

<li>
<a href="<?= BASE_URL ?>NotificacionController/index">
🔔 Ver notificaciones
</a>
</li>

<li>
<a href="<?= BASE_URL ?>AuthController/logout">
🚪 Cerrar sesión
</a>
</li>

<a href="<?= BASE_URL ?>CategoriaController/index">
Ver categorías
</a>

</ul>