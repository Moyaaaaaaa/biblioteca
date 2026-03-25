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


body{

background:linear-gradient(180deg,#2dd4bf,#ffffff);

height:100vh;

display:flex;
justify-content:center;
align-items:center;

}


.container{

background:white;

padding:60px;

border-radius:24px;

width:420px;

text-align:center;

box-shadow:0 25px 80px rgba(0,0,0,0.08);

}


.icono{

font-size:60px;

margin-bottom:15px;

}


h1{

font-size:34px;

margin-bottom:15px;

background:linear-gradient(90deg,#06b6d4,#14b8a6,#3b82f6);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

p{

color:#555;

font-size:14px;

margin-bottom:35px;

}

.btn{

display:inline-block;

padding:14px 28px;

border-radius:12px;

text-decoration:none;

color:white;

font-weight:500;

background:linear-gradient(90deg,#06b6d4,#14b8a6,#3b82f6);

transition:.25s;

}

.btn:hover{

transform:scale(1.05);

box-shadow:0 10px 30px rgba(0,0,0,0.15);

}

</style>

</head>

<body>

<div class="container">

<div class="icono">
⚠
</div>

<h1>Acceso incorrecto</h1>

<p>
Las credenciales ingresadas no son válidas.
<br>
Verifica tu usuario y contraseña.
</p>

<a class="btn" href="<?= BASE_URL ?>AuthController/login">
Volver al login
</a>

</div>

</body>

</html>