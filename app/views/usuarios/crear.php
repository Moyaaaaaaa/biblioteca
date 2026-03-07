<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Montserrat',sans-serif;
}

/* FONDO */

body{

background:linear-gradient(180deg,#1e3a8a,#ffffff);

min-height:100vh;

display:flex;
justify-content:center;
align-items:flex-start;

padding:80px;

}

/* CONTENEDOR */

.container{

width:520px;

background:white;

padding:45px;

border-radius:22px;

box-shadow:0 25px 70px rgba(0,0,0,0.08);

}

/* HEADER */

.header{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:35px;

}

/* TITULO */

.titulo small{

display:block;

font-size:14px;

color:#666;

margin-bottom:5px;

}

.titulo h1{

font-size:42px;

background:linear-gradient(90deg,#3b82f6,#6366f1,#7b2ff7);

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

input, select{

width:100%;

padding:12px;

margin-top:6px;

border-radius:10px;

border:1px solid #ddd;

font-size:14px;

transition:.25s;

}

input:focus, select:focus{

outline:none;

border-color:#3b82f6;

box-shadow:0 0 0 2px rgba(59,130,246,0.15);

}

/* BOTON */

button{

margin-top:25px;

width:100%;

padding:14px;

border:none;

border-radius:12px;

font-size:15px;

font-weight:500;

color:white;

cursor:pointer;

background:linear-gradient(90deg,#3b82f6,#6366f1,#7b2ff7);

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

<div class="titulo">

<h1>Crear</h1>

<h1>Usuario</h1>

</div>

<?php if($_SESSION['usuario']['id_rol'] == 1): ?>

<a class="volver" href="<?= BASE_URL ?>AdminController/index">
← Volver
</a>

<?php else: ?>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioController/index">
← Volver
</a>

<?php endif; ?>

</div>

<form method="POST" action="<?= BASE_URL ?>UsuarioController/guardar">

<label>Nombre</label>
<input type="text" name="nombre" required>

<br><br>

<label>Apellido paterno</label>
<input type="text" name="apellido_paterno" required>

<br><br>

<label>Apellido materno</label>
<input type="text" name="apellido_materno">

<br><br>

<label>Username</label>
<input type="text" name="username" required>

<br><br>

<label>Correo</label>
<input type="email" name="correo" required>

<br><br>

<label>Contraseña</label>
<input type="password" name="contrasenia" required>

<br><br>

<label>Fecha de nacimiento</label>
<input type="date" name="fecha_nacimiento" required>

<br><br>

<label>Rol</label>

<select name="id_rol" required>

<?php foreach($data['roles'] as $rol): ?>

<option value="<?= $rol['id_rol'] ?>">
<?= $rol['nombre_rol'] ?>
</option>

<?php endforeach; ?>

</select>

<button type="submit">
Crear usuario
</button>

</form>

</div>

</body>

</html>