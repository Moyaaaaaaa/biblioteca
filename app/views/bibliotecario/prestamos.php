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

/* TITULO */

h2{

font-size:40px;

margin-bottom:30px;

background:linear-gradient(90deg,#6366f1,#06b6d4,#9333ea);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* TABLA */

table{

width:100%;

border-collapse:collapse;

background:#f8f8fa;

border-radius:15px;

overflow:hidden;

box-shadow:0 10px 30px rgba(0,0,0,0.08);

}

/* ENCABEZADO */

th{

background:#111;

color:white;

padding:15px;

font-weight:500;

text-align:left;

}

/* FILAS */

td{

padding:15px;

border-bottom:1px solid #eee;

}

tr{
transition:.2s;
}

tr:hover{
background:#f0f0f5;
}

/* BOTON DEVOLUCION */

.btn-devolver{

text-decoration:none;

padding:6px 14px;

border-radius:8px;

background:#ecfccb;

color:#65a30d;

font-size:14px;

transition:.3s;

}

.btn-devolver:hover{

background:#65a30d;

color:white;

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

background:#333;

transform:scale(1.05);

}

</style>

</head>

<body>

<h2>Préstamos Activos</h2>

<table>

<tr>
<th>Usuario</th>
<th>Libro</th>
<th>Código Ejemplar</th>
<th>Fecha Préstamo</th>
<th>Fecha Límite</th>
<th>Condición Actual</th>
<th>Acción</th>
</tr>

<?php foreach($data['prestamos'] as $p): ?>

<tr>

<td><?= $p['nombre'] ?></td>

<td><?= $p['titulo'] ?></td>

<td><?= $p['codigo_etiqueta'] ?></td>

<td><?= $p['fecha_prestamo'] ?></td>

<td><?= $p['fecha_limite'] ?></td>

<td><?= $p['condicion'] ?></td>

<td>

<a class="btn-devolver"
href="<?= BASE_URL ?>BibliotecarioController/devolver/<?= $p['id_prestamo'] ?>">

Registrar devolución

</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<br>

<?php if($_SESSION['usuario']['id_rol']==1): ?>

<a href="<?= BASE_URL ?>AdminController/index">
Volver
</a>

<?php else: ?>

<a href="<?= BASE_URL ?>BibliotecarioController/index">
Volver
</a>

<?php endif; ?>

</body>

</html>