<h2>Mis Notificaciones</h2>

<table border="1">
    <tr>
        <th>Mensaje</th>
        <th>Fecha</th>
        <th>Hora</th>
    </tr>

    <?php foreach($data['notificaciones'] as $n): ?>
        <tr>
            <td><?= $n['mensaje'] ?></td>
            <td><?= $n['fecha_notificacion'] ?></td>
            <td><?= $n['hora_notificacion'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>