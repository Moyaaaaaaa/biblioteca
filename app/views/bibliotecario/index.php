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

/* GRID */

.grid{

display:grid;

grid-template-columns:repeat(auto-fill,minmax(250px,1fr));

gap:30px;

}

/* TARJETAS */

.card{

background:#f5f5f7;

border-radius:18px;

padding:30px;

text-decoration:none;

color:#111;

box-shadow:0 10px 25px rgba(0,0,0,0.08);

transition:.35s;

display:flex;

flex-direction:column;

align-items:center;

justify-content:center;

text-align:center;

}

.card:hover{

transform:translateY(-8px) scale(1.03);

box-shadow:0 20px 40px rgba(0,0,0,0.12);

}

/* ICONO */

.icon{

font-size:45px;

margin-bottom:12px;

}

/* TEXTO */

.text{

font-size:18px;

font-weight:500;

}

/* BOTON CERRAR */

.logout{

margin-top:50px;

display:inline-block;

padding:12px 22px;

border-radius:12px;

text-decoration:none;

background:#111;

color:white;

transition:.3s;

}

.logout:hover{

background:#333;

}

</style>

</head>

<body>

<h2>Panel del Bibliotecario</h2>

<div class="grid">

<a class="card" href="<?= BASE_URL ?>BibliotecarioLibroController/index">
<div class="icon">📚</div>
<div class="text">Gestionar Libros</div>
</a>

<a class="card" href="<?= BASE_URL ?>BibliotecarioEjemplarController/index">
<div class="icon">📦</div>
<div class="text">Gestionar Ejemplares</div>
</a>

<a class="card" href="<?= BASE_URL ?>BibliotecarioAutorController/index">
<div class="icon">✍️</div>
<div class="text">Gestionar Autores</div>
</a>

<a class="card" href="<?= BASE_URL ?>BibliotecarioCategoriaController/index">
<div class="icon">🏷️</div>
<div class="text">Gestionar Categorías</div>
</a>

<a class="card" href="<?= BASE_URL ?>BibliotecarioController/prestamosActivos">
<div class="icon">📖</div>
<div class="text">Préstamos Activos</div>
</a>

<a class="card" href="<?= BASE_URL ?>MultaController/index">
<div class="icon">💰</div>
<div class="text">Gestión de Multas</div>
</a>

<a class="card" href="<?= BASE_URL ?>BibliotecarioController/prestamosActivos">
<div class="icon">↩️</div>
<div class="text">Gestionar Devoluciones</div>
</a>

<a class="card" href="<?= BASE_URL ?>BibliotecarioEditorialController/index">
<div class="icon">🏢</div>
<div class="text">Gestionar Editoriales</div>
</a>

<a class="card" href="<?= BASE_URL ?>UsuarioController/index">
<div class="icon">👤</div>
<div class="text">Gestionar Usuarios</div>
</a>

</div>

<a class="logout" href="<?= BASE_URL ?>AuthController/logout">
🚪 Cerrar sesión
</a>

</body>

</html>