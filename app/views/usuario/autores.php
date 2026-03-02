<h2>Lista de Autores</h2>

<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Nacionalidad</th>
        <th>Total Libros</th>
    </tr>

    <?php foreach($data['autores'] as $autor): ?>

        <tr>
            <td><?= $autor['nombre'] ?></td>
            <td><?= $autor['apellido_paterno'] ?></td>
            <td><?= $autor['apellido_materno'] ?></td>
            <td><?= $autor['nacionalidad'] ?></td>
            <td><?= $autor['total_libros'] ?></td>
        </tr>

    <?php endforeach; ?>

</table>