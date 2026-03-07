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

margin-bottom:50px;

background:linear-gradient(90deg,#6366f1,#06b6d4,#9333ea);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* GRID LIBROS */

.grid{

display:grid;

grid-template-columns:repeat(auto-fill,minmax(260px,1fr));

gap:30px;

}

/* TARJETA */

.card{

background:#f6f6f8;

border-radius:18px;

padding:25px;

box-shadow:0 10px 25px rgba(0,0,0,0.08);

transition:.35s;

display:flex;

flex-direction:column;

justify-content:space-between;

}

.card:hover{

transform:translateY(-8px);

box-shadow:0 20px 40px rgba(0,0,0,0.12);

}

/* ICONO */

.icon{

font-size:40px;

margin-bottom:15px;

}

/* TITULO LIBRO */

.titulo{

font-size:20px;

font-weight:600;

margin-bottom:10px;

}

/* INFO */

.info{

font-size:14px;

color:#555;

margin-bottom:4px;

}

/* DISPONIBLE */

.disponible{

color:#10b981;

font-weight:600;

}

.no{

color:#ef4444;

font-weight:600;

}

/* BOTON */

.btn{

margin-top:15px;

border:none;

padding:10px;

border-radius:10px;

background:linear-gradient(90deg,#6366f1,#06b6d4);

color:white;

cursor:pointer;

transition:.3s;

}

.btn:hover{

transform:scale(1.05);

box-shadow:0 8px 20px rgba(0,0,0,0.15);

}

/* VOLVER */

.volver{

display:inline-block;

margin-top:50px;

padding:12px 22px;

background:#111;

color:white;

text-decoration:none;

border-radius:10px;

transition:.3s;

}

.volver:hover{

background:#333;

}

</style>

</head>

<body>

<h2>

Libros de <?= $data['autor']['nombre'] ?>

</h2>

<div class="grid">

<?php foreach($data['libros'] as $libro): ?>

<div class="card">

<div>

<div class="icon">
📚
</div>

<div class="titulo">

<?= $libro['titulo'] ?>

</div>

<div class="info">
ISBN: <?= $libro['isbn'] ?>
</div>

<div class="info">
Año: <?= $libro['anio_publicacion'] ?>
</div>

<div class="info">
Categoría: <?= $libro['categoria'] ?>
</div>

<div class="info">
Ejemplares: <?= $libro['total_ejemplares'] ?>
</div>

<div class="info">

Disponibles:

<?php if($libro['disponibles']>0): ?>

<span class="disponible">
<?= $libro['disponibles'] ?>
</span>

<?php else: ?>

<span class="no">
0
</span>

<?php endif; ?>

</div>

</div>

<div>

<?php if($libro['disponibles']>0): ?>

<form method="POST" action="<?= BASE_URL ?>PrestamoController/crear">

<input type="hidden" name="id_libro" value="<?= $libro['id_libro'] ?>">

<button class="btn" type="submit">
Prestar
</button>

</form>

<?php else: ?>

<span class="no">
No disponible
</span>

<?php endif; ?>

</div>

</div>

<?php endforeach; ?>

</div>

<a class="volver" href="<?= BASE_URL ?>AutorController/index">

Volver a autores

</a>

</body>

</html>