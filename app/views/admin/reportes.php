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
}

.container{

width:900px;
margin:auto;

background:#f8f8fa;

padding:40px;

border-radius:20px;

box-shadow:0 15px 40px rgba(0,0,0,0.08);

}

h2{

font-size:36px;

margin-bottom:30px;

background:linear-gradient(90deg,#6366f1,#06b6d4,#9333ea);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

table{

width:100%;
border-collapse:collapse;
margin-bottom:40px;

}

th{

text-align:left;
padding:10px;

background:#6366f1;
color:white;

}

td{

padding:10px;
border-bottom:1px solid #ddd;

}

.volver{

display:inline-block;

margin-top:20px;

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

<h2>Reportes del sistema</h2>

<h3>Inventario de libros</h3>

<table>

<tr>
<th>Título</th>
<th>Total ejemplares</th>
</tr>

<?php foreach($data['inventario'] as $r): ?>

<tr>

<td><?= $r['titulo'] ?></td>
<td><?= $r['total'] ?></td>

</tr>

<?php endforeach ?>

</table>



<h3>Libros más prestados</h3>

<table>

<tr>
<th>Título</th>
<th>Préstamos</th>
</tr>

<?php foreach($data['prestados'] as $r): ?>

<tr>

<td><?= $r['titulo'] ?></td>
<td><?= $r['prestamos'] ?></td>

</tr>

<?php endforeach ?>

</table>



<h3>Préstamos vencidos</h3>

<table>

<tr>
<th>Usuario</th>
<th>Libro</th>
<th>Fecha límite</th>
</tr>

<?php foreach($data['vencidos'] as $r): ?>

<tr>

<td><?= $r['username'] ?></td>
<td><?= $r['titulo'] ?></td>
<td><?= $r['fecha_limite'] ?></td>

</tr>

<?php endforeach ?>

</table>



<h3>Usuarios con multas</h3>

<table>

<tr>
<th>Usuario</th>
<th>Monto</th>
</tr>

<?php foreach($data['multas'] as $r): ?>

<tr>

<td><?= $r['username'] ?></td>
<td>$<?= $r['monto_total'] ?></td>

</tr>

<?php endforeach ?>

</table>

<a class="volver" href="<?= BASE_URL ?>AdminController/index">
← Volver
</a>

</div>

</body>

</html>