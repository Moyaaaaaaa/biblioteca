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

background:#000;

min-height:100vh;

display:flex;
justify-content:center;
align-items:flex-start;

padding:80px;

color:white;

}


.container{

width:420px;

background:#111;

padding:40px;

border-radius:20px;

box-shadow:0 20px 60px rgba(0,0,0,0.8);

}


.header{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:35px;

}


h2{

font-size:32px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);

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

transition:.25s;

}

.volver:hover{

transform:translateY(-2px);

box-shadow:0 8px 20px rgba(0,0,0,0.5);

}


label{

font-size:14px;

font-weight:500;

color:#ccc;

}

input{

width:100%;

padding:12px;

margin-top:6px;

border-radius:10px;

border:1px solid #333;

background:#000;

color:white;

font-size:14px;

transition:.25s;

}

input:focus{

outline:none;

border-color:#7b2ff7;

box-shadow:0 0 0 2px rgba(123,47,247,0.25);

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

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);

transition:.25s;

}

button:hover{

transform:scale(1.03);

box-shadow:0 10px 30px rgba(0,0,0,0.5);

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h2>Agregar Categoría</h2>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioCategoriaController/index">
← Volver
</a>

</div>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioCategoriaController/guardar">

<label>Nombre de categoría</label>

<input type="text" name="categoria" required>

<button type="submit">
Guardar Categoría
</button>

</form>

</div>

</body>

</html>