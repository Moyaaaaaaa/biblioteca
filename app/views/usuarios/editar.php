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

background:linear-gradient(180deg,#f9a8d4,#ffffff);

min-height:100vh;

display:flex;
justify-content:center;
align-items:flex-start;

padding:80px;

}

/* TARJETA */

.container{

width:540px;

background:white;

padding:50px;

border-radius:24px;

box-shadow:0 25px 80px rgba(0,0,0,0.08);

}

/* HEADER */

.header{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:40px;

}

/* TITULO */

.titulo h1{

font-size:42px;

background:linear-gradient(90deg,#ec4899,#f472b6,#fb7185);

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

/* FORM GRID */

.form-grid{

display:grid;

grid-template-columns:1fr 1fr;

gap:20px;

}

/* CAMPOS */

.campo{

display:flex;
flex-direction:column;

}

/* LABEL */

label{

font-size:13px;

color:#555;

margin-bottom:5px;

}

/* INPUTS */

input, select{

padding:12px;

border-radius:10px;

border:1px solid #eee;

background:#fafafa;

font-size:14px;

transition:.25s;

}

input:focus, select:focus{

outline:none;

border-color:#ec4899;

background:white;

box-shadow:0 0 0 2px rgba(236,72,153,0.15);

}

/* CAMPO ANCHO */

.full{

grid-column:span 2;

}

/* BOTON */

button{

margin-top:30px;

width:100%;

padding:14px;

border:none;

border-radius:12px;

font-size:15px;

font-weight:500;

color:white;

cursor:pointer;

background:linear-gradient(90deg,#ec4899,#f472b6,#fb7185);

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
<h1>Editar Usuario</h1>
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

<form method="POST" action="<?= BASE_URL ?>UsuarioController/actualizar">

<input type="hidden" 
name="id_usuario" 
value="<?= $data['usuario']['id_usuario'] ?>">

<div class="form-grid">

<div class="campo">
<label>Nombre</label>
<input type="text" name="nombre"
value="<?= $data['usuario']['nombre'] ?>" required>
</div>

<div class="campo">
<label>Apellido paterno</label>
<input type="text" name="apellido_paterno"
value="<?= $data['usuario']['apellido_paterno'] ?>" required>
</div>

<div class="campo">
<label>Apellido materno</label>
<input type="text" name="apellido_materno"
value="<?= $data['usuario']['apellido_materno'] ?>">
</div>

<div class="campo">
<label>Username</label>
<input type="text" name="username"
value="<?= $data['usuario']['username'] ?>" required>
</div>

<div class="campo full">
<label>Correo</label>
<input type="email" name="correo"
value="<?= $data['usuario']['correo'] ?>" required>
</div>

<div class="campo full">
<label>Rol</label>

<select name="id_rol">

<?php foreach($data['roles'] as $rol): ?>

<option 
value="<?= $rol['id_rol'] ?>"
<?= $rol['id_rol'] == $data['usuario']['id_rol'] ? 'selected' : '' ?>>

<?= $rol['nombre_rol'] ?>

</option>

<?php endforeach; ?>

</select>

</div>

</div>

<button type="submit">
Actualizar usuario
</button>

</form>

</div>

</body>

</html>