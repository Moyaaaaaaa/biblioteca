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


.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:50px;
}


h2{

font-size:42px;

background:linear-gradient(90deg,#7dd3fc,#6366f1,#9333ea);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}


.volver{

text-decoration:none;

background:white;
color:black;

padding:10px 18px;

border-radius:10px;

font-size:13px;

transition:.3s;

}

.volver:hover{

transform:translateY(-2px);

box-shadow:0 8px 20px rgba(0,0,0,0.6);

}

.grid{

display:grid;

grid-template-columns:repeat(auto-fill,minmax(260px,1fr));

gap:30px;

}


.card{

background:#111;

border-radius:18px;

padding:30px;

transition:.35s;

box-shadow:0 10px 30px rgba(0,0,0,0.6);

}

.card:hover{

transform:translateY(-8px) scale(1.03);

box-shadow:0 20px 50px rgba(0,0,0,0.8);

}


.icon{

font-size:40px;

margin-bottom:15px;

}


.nombre{

font-size:22px;

font-weight:600;

margin-bottom:8px;

}


.info{

font-size:14px;

color:#aaa;

margin-bottom:4px;

}


.btn{

display:inline-block;

margin-top:15px;

padding:10px 16px;

border-radius:10px;

text-decoration:none;

background:linear-gradient(90deg,#6366f1,#06b6d4);

color:white;

font-size:14px;

transition:.3s;

}

.btn:hover{

transform:scale(1.05);

box-shadow:0 8px 20px rgba(0,0,0,0.6);

}

</style>

</head>

<body>

<div class="header">

<h2>Autores</h2>

<a class="volver" href="<?= BASE_URL ?>DashboardController/index">
← Volver
</a>

</div>

<div class="grid">

<?php foreach ($data['autores'] as $autor): ?>

<div class="card">

<div class="icon">
✍️
</div>

<div class="nombre">

<?= $autor['nombre'] ?>

<?= $autor['apellido_paterno'] ?>

<?= $autor['apellido_materno'] ?>

</div>

<div class="info">

Nacionalidad:
<?= $autor['nacionalidad'] ?>

</div>

<a class="btn"
href="<?= BASE_URL ?>AutorController/libros/<?= $autor['id_autor'] ?>">

Ver libros

</a>

</div>

<?php endforeach; ?>

</div>

</body>

</html>