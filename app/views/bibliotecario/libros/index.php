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

/* BOTON AGREGAR */

.btn-agregar{

display:inline-block;
margin-bottom:30px;

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

.barra-superior{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:30px;

}

.btn-volver{

padding:10px 20px;

border-radius:12px;

background:#111;

color:white;

text-decoration:none;

transition:.3s;

}

.btn-volver:hover{

background:#333;

transform:scale(1.05);

box-shadow:0 10px 25px rgba(0,0,0,0.15);

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

/* BOTONES ACCION */

.accion{

text-decoration:none;

padding:6px 12px;

border-radius:8px;

font-size:14px;

margin-right:5px;

transition:.3s;

}

/* EDITAR */

.editar{

background:#e0f2fe;

color:#0284c7;

}

.editar:hover{

background:#0284c7;

color:white;

}

/* ELIMINAR */

.eliminar{

background:#fee2e2;

color:#dc2626;

}

.eliminar:hover{

background:#dc2626;

color:white;

}

/* EJEMPLAR */

.ejemplar{

background:#ecfccb;

color:#65a30d;

}

.ejemplar:hover{

background:#65a30d;

color:white;

}

</style>

</head>

<body>

<div class="barra-superior">

<h2>Gestión de Libros</h2>

<?php if($_SESSION['usuario']['id_rol']==1): ?>

<a class="btn-volver" href="<?= BASE_URL ?>AdminController/index">
← Volver al panel
</a>

<?php else: ?>

<a class="btn-volver" href="<?= BASE_URL ?>BibliotecarioController/index">
← Volver al panel
</a>

<?php endif; ?>

</div>

<a class="btn-agregar" href="<?= BASE_URL ?>BibliotecarioLibroController/crear">
+ Agregar Libro
</a>

<table>

<tr>
<th>ID</th>
<th>Título</th>
<th>ISBN</th>
<th>Año</th>
<th>Categoría</th>
<th>Autores</th>
<th>Ejemplares</th>
<th>Acciones</th>
</tr>

<?php foreach($data['libros'] as $libro): ?>

<tr>

<td><?= $libro['id_libro'] ?></td>

<td><?= $libro['titulo'] ?></td>

<td><?= $libro['isbn'] ?></td>

<td><?= $libro['anio_publicacion'] ?></td>

<td><?= $libro['categoria'] ?></td>

<td><?= $libro['autores'] ?? '—' ?></td>

<td><?= $libro['ejemplares'] ?></td>

<td>

<a class="accion editar"
href="<?= BASE_URL ?>BibliotecarioLibroController/editar/<?= $libro['id_libro'] ?>">
Editar
</a>

<a class="accion eliminar"
href="<?= BASE_URL ?>BibliotecarioLibroController/eliminar/<?= $libro['id_libro'] ?>">
Eliminar
</a>

<a class="accion ejemplar"
href="<?= BASE_URL ?>BibliotecarioEjemplarController/crear/<?= $libro['id_libro'] ?>">
Agregar ejemplar
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>