<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Notificaciones</title>

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

/* HEADER */

.header{

display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:40px;

}

/* titulo */

h2{

font-size:36px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* boton volver */

.volver{

text-decoration:none;
background:black;
color:white;

padding:10px 18px;
border-radius:10px;

font-size:13px;

transition:.25s;

}

.volver:hover{

transform:translateY(-2px);
box-shadow:0 6px 15px rgba(0,0,0,0.2);

}

/* contenedor */

.notificaciones{

max-width:800px;

}

/* card */

.notificacion{

border:1px solid #eee;
border-radius:14px;
padding:20px;
margin-bottom:20px;

display:flex;
align-items:center;
gap:15px;

transition:all .25s;

}

/* animacion */

.notificacion:hover{

transform:translateY(-3px);
box-shadow:0 8px 20px rgba(0,0,0,0.08);

}

/* icono */

.icono{

font-size:22px;
color:black;

}

/* texto */

.texto{

flex:1;
font-size:14px;
color:#444;

}

/* fecha */

.fecha{

font-size:12px;
color:#999;

}

/* etiqueta */

.tipo{

font-size:11px;
padding:4px 8px;
border-radius:6px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);
color:white;

}

</style>

</head>

<body>

<div class="header">

<h2>Notificaciones</h2>

<a class="volver" href="<?= BASE_URL ?>DashboardController/index">
← Volver
</a>

</div>

<div class="notificaciones">

<?php foreach($data['notificaciones'] as $n): ?>

<div class="notificacion">

<div class="icono">
<i class="fa fa-bell"></i>
</div>

<div class="texto">

<div>
<?= $n['mensaje'] ?>
</div>

<div class="fecha">
<?= $n['fecha'] ?? '' ?>
</div>

</div>

<div class="tipo">
Aviso
</div>

</div>

<?php endforeach; ?>

</div>

</body>

</html>