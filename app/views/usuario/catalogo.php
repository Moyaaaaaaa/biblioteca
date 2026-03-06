<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Catálogo Biblioteca</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Montserrat',sans-serif;
}

body{
background:white;
padding:60px;
}

/* titulo */

h2{

font-size:36px;
margin-bottom:40px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* tabla */

table{

width:100%;
border-collapse:collapse;

}

/* encabezado */

th{

text-align:left;
font-weight:500;
padding:14px;
border-bottom:1px solid #eee;
color:#666;

}

/* filas */

td{

padding:18px 14px;
border-bottom:1px solid #f3f3f3;
font-size:14px;

}

/* hover fila */

tr:hover{

background:#fafafa;

}

/* boton prestar */

.btn-prestar{

padding:8px 16px;
border-radius:8px;
border:none;
font-size:13px;
cursor:pointer;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);
color:white;

transition:all .25s;

}

/* animacion boton */

.btn-prestar:hover{

transform:translateY(-2px);
box-shadow:0 6px 14px rgba(0,0,0,0.15);

}

/* boton deshabilitado */

.no-disponible{

color:#999;
font-size:13px;

}

/* volver */

.volver{

margin-top:40px;
display:inline-block;
text-decoration:none;
color:black;
font-size:14px;

}

.volver:hover{

text-decoration:underline;

}

</style>

</head>


<body>

<h2>Catálogo Biblioteca</h2>

<table>

<tr>
<th>Título</th>
<th>ISBN</th>
<th>Año</th>
<th>Autor(es)</th>
<th>Categoría</th>
<th>Total</th>
<th>Disponibles</th>
<th></th>
</tr>

<?php foreach($data['libros'] as $libro): ?>

<tr>

<td><?= $libro['titulo'] ?></td>

<td><?= $libro['isbn'] ?></td>

<td><?= $libro['anio_publicacion'] ?></td>

<td><?= $libro['autores'] ?? 'Sin autor' ?></td>

<td><?= $libro['categoria'] ?></td>

<td><?= $libro['total_ejemplares'] ?></td>

<td><?= $libro['disponibles'] ?></td>

<td>

<?php if($libro['disponibles'] > 0): ?>

<form method="POST" action="<?= BASE_URL ?>PrestamoController/crear">

<input type="hidden" name="id_libro" value="<?= $libro['id_libro'] ?>">

<button class="btn-prestar" type="submit">
Prestar
</button>

</form>

<?php else: ?>

<span class="no-disponible">
No disponible
</span>

<?php endif; ?>

</td>

</tr>

<?php endforeach; ?>

</table>


<a class="volver" href="<?= BASE_URL ?>DashboardController/index">
← Volver
</a>

</body>

</html>