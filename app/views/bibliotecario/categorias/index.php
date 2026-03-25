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

.barra{

display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;

}


h2{

font-size:40px;

background:linear-gradient(90deg,#00f2ff,#7b61ff,#ff4ecd);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}


.btn-agregar{

padding:10px 20px;

border-radius:12px;

background:linear-gradient(90deg,#00f2ff,#7b61ff);

color:white;

text-decoration:none;

font-weight:500;

transition:.3s;

}

.btn-agregar:hover{

transform:scale(1.05);

box-shadow:0 10px 30px rgba(0,255,255,0.4);

}

table{

width:100%;

border-collapse:collapse;

background:#111;

border-radius:15px;

overflow:hidden;

box-shadow:0 15px 40px rgba(0,0,0,0.6);

}


th{

background:#000;

color:#00f2ff;

padding:15px;

font-weight:500;

text-align:left;

border-bottom:1px solid #222;

}


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


.accion{

text-decoration:none;

padding:6px 12px;

border-radius:8px;

font-size:14px;

margin-right:5px;

transition:.3s;

}


.editar{

background:#1f2937;

color:#00f2ff;

}

.editar:hover{

background:#00f2ff;

color:#000;

}


.eliminar{

background:#1f2937;

color:#ff4ecd;

}

.eliminar:hover{

background:#ff4ecd;

color:#000;

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

background:#00f2ff;

color:#000;

transform:scale(1.05);

}

</style>

</head>

<body>

<div class="barra">

<h2>Gestión de Categorías</h2>

<a class="btn-agregar" href="<?= BASE_URL ?>BibliotecarioCategoriaController/crear">
+ Agregar Categoría
</a>

</div>

<table>

<tr>
<th>ID</th>
<th>Categoría</th>
<th>Acciones</th>
</tr>

<?php foreach($data['categorias'] as $categoria): ?>

<tr>

<td><?= $categoria['id_categoria'] ?></td>

<td><?= $categoria['categoria'] ?></td>

<td>

<a class="accion editar"
href="<?= BASE_URL ?>BibliotecarioCategoriaController/editar/<?= $categoria['id_categoria'] ?>">
Editar
</a>

<a class="accion eliminar"
href="<?= BASE_URL ?>BibliotecarioCategoriaController/eliminar/<?= $categoria['id_categoria'] ?>">
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