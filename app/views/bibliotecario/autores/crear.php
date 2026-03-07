<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Montserrat',sans-serif;
}

/* FONDO */

body{

background:linear-gradient(180deg,#bbf7d0,#ffffff);

min-height:100vh;

display:flex;
justify-content:center;
align-items:flex-start;

padding:80px;

}

/* CONTENEDOR */

.container{

width:480px;

background:white;

padding:40px;

border-radius:20px;

box-shadow:0 20px 50px rgba(0,0,0,0.08);

}

/* HEADER */

.header{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:35px;

}

/* TITULO */

h2{

font-size:32px;

background:linear-gradient(90deg,#22c55e,#16a34a,#15803d);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* BOTON VOLVER */

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

box-shadow:0 8px 20px rgba(0,0,0,0.2);

}

/* LABEL */

label{

font-size:14px;

font-weight:500;

color:#444;

}

/* INPUTS */

input{

width:100%;

padding:12px;

margin-top:6px;

border-radius:10px;

border:1px solid #ddd;

font-size:14px;

transition:.25s;

}

input:focus{

outline:none;

border-color:#22c55e;

box-shadow:0 0 0 2px rgba(34,197,94,0.15);

}

/* BOTON */

button{

margin-top:20px;

width:100%;

padding:14px;

border:none;

border-radius:12px;

font-size:15px;

font-weight:500;

color:white;

cursor:pointer;

background:linear-gradient(90deg,#22c55e,#16a34a,#15803d);

transition:.25s;

}

button:hover{

transform:scale(1.03);

box-shadow:0 10px 30px rgba(0,0,0,0.15);

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h2>Agregar Autor</h2>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioAutorController/index">
← Volver
</a>

</div>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioAutorController/guardar">

<label>Nombre</label>
<input type="text" name="nombre" required>

<br><br>

<label>Apellido paterno</label>
<input type="text" name="apellido_paterno" required>

<br><br>

<label>Apellido materno</label>
<input type="text" name="apellido_materno">

<br><br>

<label>Nacionalidad</label>
<input type="text" name="nacionalidad">

<button type="submit">
Guardar Autor
</button>

</form>

</div>

</body>

</html>