<h2>Mis Devoluciones</h2>

<table border="1">
    <tr>
        <th>Libro</th>
        <th>Fecha Préstamo</th>
        <th>Fecha Devolución</th>
        <th>Días de Retraso</th>
    </tr>

    <?php foreach($data['devoluciones'] as $dev): ?>

        <tr>
            <td><?= $dev['titulo'] ?></td>
            <td><?= $dev['fecha_prestamo'] ?></td>
            <td><?= $dev['fecha_devolucion'] ?></td>
            <td>
                <?php if($dev['dias_retraso'] > 0): ?>
                    <?= $dev['dias_retraso'] ?> días
                <?php else: ?>
                    Sin retraso
                <?php endif; ?>
            </td>
        </tr>

    <?php endforeach; ?>

</table>