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


.barra{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}


h2{
font-size:40px;
background:linear-gradient(90deg,#6366f1,#06b6d4,#9333ea);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}


.btn-agregar{
padding:10px 20px;
border-radius:12px;
background:linear-gradient(90deg,#6366f1,#06b6d4);
color:white;
text-decoration:none;
font-weight:500;
transition:.3s;
}

.btn-agregar:hover{
transform:scale(1.05);
box-shadow:0 10px 25px rgba(0,0,0,0.15);
}


table{
width:100%;
border-collapse:collapse;
background:#f8f8fa;
border-radius:15px;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
}


th{
background:#111;
color:white;
padding:15px;
text-align:left;
}


td{
padding:15px;
border-bottom:1px solid #eee;
}

tr{
transition:.25s;
}

tr:hover{
background:#f0f0f5;
}


.accion{
text-decoration:none;
padding:6px 12px;
border-radius:8px;
font-size:14px;
margin-right:5px;
transition:.3s;
}


.editar{
background:#e0f2fe;
color:#0284c7;
}

.editar:hover{
background:#0284c7;
color:white;
}


.eliminar{
background:#fee2e2;
color:#dc2626;
}

.eliminar:hover{
background:#dc2626;
color:white;
}


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

<div class="barra">

<h2>Gestión de Editoriales</h2>

<a class="btn-agregar" href="<?= BASE_URL ?>BibliotecarioEditorialController/crear">
+ Agregar Editorial
</a>

</div>

<table>

<tr>
<th>ID</th>
<th>Editorial</th>
<th>Acciones</th>
</tr>

<?php foreach($data['editoriales'] as $e): ?>

<tr>

<td><?= $e['id_editorial'] ?></td>

<td><?= $e['editorial'] ?></td>

<td>

<a class="accion editar"
href="<?= BASE_URL ?>BibliotecarioEditorialController/editar/<?= $e['id_editorial'] ?>">
Editar
</a>

<a class="accion eliminar"
href="<?= BASE_URL ?>BibliotecarioEditorialController/eliminar/<?= $e['id_editorial'] ?>">
Eliminar
</a>

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