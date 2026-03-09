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
background:#ffffff;
padding:60px;
display:flex;
justify-content:center;
}

/* CONTENEDOR */

.container{

width:900px;

background:#f8f8fa;

padding:40px;

border-radius:20px;

box-shadow:0 15px 40px rgba(0,0,0,0.08);

}

/* TITULO */

h2{

font-size:36px;

margin-bottom:30px;

background:linear-gradient(90deg,#6366f1,#06b6d4,#9333ea);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* TABLA */

table{

width:100%;

border-collapse:collapse;

margin-top:20px;

background:white;

border-radius:10px;

overflow:hidden;

}

th{

text-align:left;

padding:12px;

background:#6366f1;

color:white;

font-weight:500;

}

td{

padding:12px;

border-bottom:1px solid #eee;

}

tr:hover{

background:#f3f4f6;

}

/* VOLVER */

.volver{

display:inline-block;

margin-top:30px;

padding:10px 18px;

border-radius:12px;

background:#111;

color:white;

text-decoration:none;

transition:.3s;

}

.volver:hover{

background:#333;

transform:scale(1.05);

}

</style>

</head>

<body>

<div class="container">

<h2>Bitácora del sistema</h2>

<table>

<tr>
<th>Fecha</th>
<th>Hora</th>
<th>Acción</th>
<th>Descripción</th>
</tr>

<?php foreach($data['registros'] as $r): ?>

<tr>

<td><?= $r['fecha_bitacora'] ?></td>
<td><?= $r['hora'] ?></td>
<td><?= $r['accion'] ?></td>
<td><?= $r['descripcion_detallada'] ?></td>

</tr>

<?php endforeach ?>

</table>

<a class="volver" href="<?= BASE_URL ?>AdminController/index">
← Volver
</a>

</div>

</body>

</html>