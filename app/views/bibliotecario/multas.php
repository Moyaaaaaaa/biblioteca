<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Montserrat',sans-serif;
}

body{
background:#000;
color:white;
padding:60px;
}

/* TITULO */

h2{

font-size:40px;

margin-bottom:30px;

background:linear-gradient(90deg,#00f2ff,#7b61ff,#ff4ecd);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* TABLA */

table{

width:100%;

border-collapse:collapse;

background:#111;

border-radius:15px;

overflow:hidden;

box-shadow:0 15px 40px rgba(0,0,0,0.6);

}

/* ENCABEZADO */

th{

background:#000;

color:#00f2ff;

padding:15px;

text-align:left;

border-bottom:1px solid #222;

}

/* FILAS */

td{

padding:15px;

border-bottom:1px solid #222;

}

tr{
transition:.25s;
}

tr:hover{
background:#1a1a1a;
}

/* ESTADOS */

.estado-pendiente{
color:#ff4ecd;
font-weight:500;
}

.estado-pagada{
color:#00f2ff;
font-weight:500;
}

/* BOTON PAGAR */

.btn-pagar{

padding:6px 14px;

border-radius:8px;

border:none;

background:linear-gradient(90deg,#00f2ff,#7b61ff);

color:white;

cursor:pointer;

transition:.3s;

}

.btn-pagar:hover{

transform:scale(1.05);

box-shadow:0 0 15px rgba(0,255,255,0.6);

}

/* CHECK PAGADO */

.check{

color:#00f2ff;
font-size:18px;

}

/* BOTON VOLVER */

.volver{

display:inline-block;

margin-top:30px;

padding:10px 20px;

border-radius:12px;

background:#111;

color:white;

text-decoration:none;

transition:.3s;

}

.volver:hover{

background:#00f2ff;

color:#000;

transform:scale(1.05);

}

</style>

</head>

<body>

<h2>Panel de Multas</h2>

<table>

<tr>
<th>Usuario</th>
<th>Libro</th>
<th>Ejemplar</th>
<th>Motivo</th>
<th>Monto</th>
<th>Estado</th>
<th>Acción</th>
</tr>

<?php foreach($data['multas'] as $m): ?>

<tr>

<td><?= $m['usuario'] ?></td>

<td><?= $m['libro'] ?></td>

<td><?= $m['ejemplar'] ?></td>

<td><?= $m['motivos'] ?? 'Sin motivo' ?></td>

<td>$<?= $m['monto_total'] ?></td>

<td>

<?php if($m['pagada']==0): ?>

<span class="estado-pendiente">
Pendiente
</span>

<?php else: ?>

<span class="estado-pagada">
Pagada
</span>

<?php endif; ?>

</td>

<td>

<?php if($m['pagada']==0): ?>

<form method="POST" action="<?= BASE_URL ?>MultaController/pagar">

<input type="hidden" name="id_multa" value="<?= $m['id_multa'] ?>">

<button class="btn-pagar" type="submit">
Registrar pago
</button>

</form>

<?php else: ?>

<span class="check">✔</span>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<?php if($_SESSION['usuario']['id_rol']==1): ?>

<a class="volver" href="<?= BASE_URL ?>AdminController/index">
← Volver
</a>

<?php else: ?>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioController/index">
← Volver
</a>

<?php endif; ?>

</body>

</html>