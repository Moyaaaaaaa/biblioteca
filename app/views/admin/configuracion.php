<h2>Configuración del Sistema</h2>

<form method="POST" action="<?= BASE_URL ?>AdminConfiguracionController/actualizar">

    <label>Días de préstamo</label>
    <br>

    <input type="number"
        name="dias_prestamo"
        value="<?= $data['config']['dias_prestamo'] ?>">

    <br><br>

    <label>Monto multa por día</label>
    <br>

    <input type="number"
        step="0.01"
        name="multa_dia"
        value="<?= $data['config']['multa_dia'] ?>">

    <br><br>

    <button type="submit">
        Guardar configuración
    </button>

</form>

<br>

<a href="<?= BASE_URL ?>AdminController/index">
    Volver
</a>