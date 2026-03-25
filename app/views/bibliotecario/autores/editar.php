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


body{

background:linear-gradient(180deg,#fed7aa,#ffffff);

min-height:100vh;

display:flex;
justify-content:center;
align-items:flex-start;

padding:80px;

}


.container{

width:480px;

background:white;

padding:40px;

border-radius:20px;

box-shadow:0 20px 50px rgba(0,0,0,0.08);

}


.header{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:35px;

}


h2{

font-size:32px;

background:linear-gradient(90deg,#f97316,#fb923c,#f59e0b);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}


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


label{

font-size:14px;

font-weight:500;

color:#444;

}


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

border-color:#f97316;

box-shadow:0 0 0 2px rgba(249,115,22,0.15);

}

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

background:linear-gradient(90deg,#f97316,#fb923c,#f59e0b);

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

<h2>Editar Autor</h2>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioAutorController/index">
← Volver
</a>

</div>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioAutorController/actualizar">

<input type="hidden" name="id_autor" value="<?= $data['autor']['id_autor'] ?>">

<label>Nombre</label>
<input type="text" name="nombre" value="<?= $data['autor']['nombre'] ?>" required>

<br><br>

<label>Apellido paterno</label>
<input type="text" name="apellido_paterno" value="<?= $data['autor']['apellido_paterno'] ?>" required>

<br><br>

<label>Apellido materno</label>
<input type="text" name="apellido_materno" value="<?= $data['autor']['apellido_materno'] ?>">

<br><br>

<label>Nacionalidad</label>
<input type="text" name="nacionalidad" value="<?= $data['autor']['nacionalidad'] ?>" required>

<button type="submit">
Actualizar Autor
</button>

</form>

</div>

</body>

</html>