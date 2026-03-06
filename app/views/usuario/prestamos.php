<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Mis Préstamos</title>

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

/* contenedor */

.prestamos-grid{

display:grid;
grid-template-columns:repeat(auto-fill,minmax(320px,1fr));
gap:25px;

}

/* card */

.prestamo-card{

border:1px solid #eee;
border-radius:14px;
padding:25px;

transition:all .25s;

}

.prestamo-card:hover{

transform:translateY(-5px);
box-shadow:0 10px 25px rgba(0,0,0,0.08);

}

/* titulo libro */

.libro{

font-size:18px;
font-weight:600;
margin-bottom:12px;

}

/* info */

.info{

font-size:14px;
color:#666;
margin-bottom:6px;

}

/* etiqueta */

.etiqueta{

display:inline-block;
margin-top:10px;
padding:6px 12px;
font-size:12px;
border-radius:6px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);
color:white;

}

/* volver */

.volver{

margin-top:50px;
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

<h2>Mis Préstamos</h2>

<div class="prestamos-grid">

<?php foreach($data['prestamos'] as $p): ?>

<div class="prestamo-card">

<div class="libro">
<i class="fa fa-book"></i>
<?= $p['titulo'] ?>
</div>

<div class="info">
Ejemplar: <?= $p['codigo_etiqueta'] ?>
</div>

<div class="info">
Condición: <?= $p['condicion'] ?>
</div>

<div class="info">
Fecha préstamo: <?= $p['fecha_prestamo'] ?>
</div>

<div class="info">
Fecha límite: <?= $p['fecha_limite'] ?>
</div>

<div class="etiqueta">
Préstamo activo
</div>

</div>

<?php endforeach; ?>

</div>


<a class="volver" href="<?= BASE_URL ?>DashboardController/index">
← Volver
</a>

</body>

</html>