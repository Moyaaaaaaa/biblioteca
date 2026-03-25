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

background:linear-gradient(180deg,#ffd6c9,#ffffff);

min-height:100vh;

display:flex;
justify-content:center;
align-items:flex-start;

padding:80px;

}


.container{

width:450px;

background:white;

padding:40px;

border-radius:20px;

box-shadow:0 25px 60px rgba(0,0,0,0.08);

}


.header{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:40px;

}


h2{

font-size:36px;

background:linear-gradient(90deg,#ff7a18,#ff4d6d,#f97316);

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

border-color:#ff7a18;

box-shadow:0 0 0 2px rgba(255,122,24,0.15);

}


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

background:linear-gradient(90deg,#ff7a18,#ff4d6d,#f97316);

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

<h2>Agregar Editorial</h2>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioEditorialController/index">
← Volver
</a>

</div>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioEditorialController/guardar">

<label>Nombre editorial</label>

<input type="text" name="editorial" required>

<button type="submit">
Guardar
</button>

</form>

</div>

</body>

</html>