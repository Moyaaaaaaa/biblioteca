<h2>Préstamos Activos</h2>

<table border="1">
    <tr>
        <th>Usuario</th>
        <th>Libro</th>
        <th>Fecha Préstamo</th>
        <th>Fecha Límite</th>
        <th>Acción</th>
    </tr>

    <?php foreach ($data['prestamos'] as $p): ?>

        <tr>
            <td><?= $p['nombre'] ?></td>
            <td><?= $p['titulo'] ?></td>
            <td><?= $p['fecha_prestamo'] ?></td>
            <td><?= $p['fecha_limite'] ?></td>
            <td>
                <form method="POST" action="<?= BASE_URL ?>DevolucionController/devolver">

                    <input type="hidden" name="id_prestamo" value="<?= $p['id_prestamo'] ?>">

                    <select name="condicion_devuelta" required>
                        <option value="">Condición al devolver</option>
                        <option value="1">Bueno</option>
                        <option value="2">Regular</option>
                        <option value="3">Dañado</option>
                    </select>

                    <button type="submit">Registrar devolución</button>

                </form>
            </td>
        </tr>

    <?php endforeach; ?>

</table>

<br>

<a href="<?= BASE_URL ?>BibliotecarioController/index">
    Volver
</a>