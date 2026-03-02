<h2>Mis Préstamos</h2>

<table border="1">
    <tr>
        <th>Libro</th>
        <th>Fecha Préstamo</th>
        <th>Fecha Límite</th>
        <th>Días Restantes</th>
    </tr>

    <?php foreach($data['prestamos'] as $prestamo): 

        $hoy = new DateTime();
        $limite = new DateTime($prestamo['fecha_limite']);
        $diferencia = $hoy->diff($limite)->format('%r%a');
    ?>

        <tr>
            <td><?= $prestamo['titulo'] ?></td>
            <td><?= $prestamo['fecha_prestamo'] ?></td>
            <td><?= $prestamo['fecha_limite'] ?></td>
            <td>
                <?php if($diferencia >= 0): ?>
                    <?= $diferencia ?> días
                <?php else: ?>
                    Vencido (<?= abs($diferencia) ?> días)
                <?php endif; ?>
            </td>
        </tr>

    <?php endforeach; ?>

</table>