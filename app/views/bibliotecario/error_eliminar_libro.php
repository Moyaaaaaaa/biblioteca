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
display:flex;
justify-content:center;
}

/* CONTENEDOR */

.container{

width:500px;

background:#f8f8fa;

padding:40px;

border-radius:20px;

box-shadow:0 15px 40px rgba(0,0,0,0.08);

text-align:center;

}

/* TITULO */

h2{

font-size:32px;

margin-bottom:20px;

background:linear-gradient(90deg,#ef4444,#f97316);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* MENSAJE */

p{

font-size:16px;

color:#444;

margin-bottom:25px;

}

/* BOTON VOLVER */

.volver{

display:inline-block;

padding:12px 20px;

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

<h2>No se puede eliminar</h2>

<p>
No se puede eliminar el libro porque tiene ejemplares registrados.
</p>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioLibroController/index">
← Volver
</a>

</div>

</body>

</html>