<h2>Mis Multas</h2>

<?php if(empty($data['multas'])): ?>

    <p>No tienes multas registradas</p>

<?php else: ?>

<table border="1">
    <tr>
        <th>Libro</th>
        <th>Monto</th>
        <th>Fecha Devolución</th>
        <th>Estado</th>
    </tr>

    <?php foreach($data['multas'] as $multa): ?>

        <tr>
            <td><?= $multa['titulo'] ?></td>
            <td>$<?= $multa['monto_total'] ?></td>
            <td><?= $multa['fecha_devolucion'] ?></td>
            <td>
                <?php if($multa['pagada']): ?>
                    Pagada 
                <?php else: ?>
                    Pendiente 
                <?php endif; ?>
            </td>
        </tr>

    <?php endforeach; ?>

</table>

<?php endif; ?>