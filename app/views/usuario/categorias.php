<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Categorías</title>

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
padding:40px;

}

h1{

font-size:40px;
font-weight:700;
margin-bottom:10px;

}

.titulo-color{

color:#4f46e5;

}

.subtitulo{

color:#777;
margin-bottom:40px;

}


.categorias-grid{

display:grid;
grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
gap:30px;

}


.categoria-card{

height:180px;

border-radius:14px;

background:linear-gradient(135deg,#f5f5f7,#ffffff);

box-shadow:

0 10px 20px rgba(0,0,0,0.08);

padding:25px;

display:flex;
flex-direction:column;
justify-content:center;

cursor:pointer;

transition:all .35s ease;

text-decoration:none;

}

.categoria-card:hover{

transform:translateY(-8px) scale(1.03);

box-shadow:

0 20px 40px rgba(0,0,0,0.12);

}


.icono{

font-size:50px;
margin-bottom:15px;

}

/* TEXTO */

.categoria-nombre{

font-size:22px;
font-weight:600;
color:#111;

}

/* VOLVER */

.volver{

margin-top:40px;
display:inline-block;

text-decoration:none;

padding:12px 20px;

border-radius:10px;

background:#111;
color:white;

transition:.3s;

}

.volver:hover{

background:#333;

}

</style>

</head>

<body>

<h1>
Explorar 
<span class="titulo-color">
Categorías
</span>
</h1>

<p class="subtitulo">
Encuentra libros por categoría
</p>

<div class="categorias-grid">

<?php foreach($data['categorias'] as $categoria): ?>

<a class="categoria-card"
href="<?= BASE_URL ?>CategoriaController/ver/<?= $categoria['id_categoria'] ?>">

<div class="icono">

📚

</div>

<div class="categoria-nombre">

<?= htmlspecialchars($categoria['categoria']) ?>

</div>

</a>

<?php endforeach; ?>

</div>

<br><br>

<a class="volver"
href="<?= BASE_URL ?>DashboardController/index">

Volver

</a>

</body>

</html>