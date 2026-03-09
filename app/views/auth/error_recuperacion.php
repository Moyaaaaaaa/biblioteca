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

.container{

width:500px;

background:#f8f8fa;

padding:40px;

border-radius:20px;

box-shadow:0 15px 40px rgba(0,0,0,0.08);

text-align:center;

}

h2{

font-size:32px;

margin-bottom:20px;

background:linear-gradient(90deg,#ef4444,#f97316);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

p{

font-size:16px;

color:#444;

margin-bottom:25px;

}

.btn{

display:inline-block;

padding:12px 20px;

border-radius:12px;

background:linear-gradient(90deg,#6366f1,#06b6d4);

color:white;

text-decoration:none;

font-size:15px;

transition:.3s;

}

.btn:hover{

transform:scale(1.05);

box-shadow:0 10px 25px rgba(0,0,0,0.15);

}

</style>

</head>

<body>

<div class="container">

<h2>Credenciales incorrectas</h2>

<p>
El usuario o el correo ingresado no coinciden con ningún registro.
</p>

<a class="btn" href="<?= BASE_URL ?>AuthController/recuperar">
Intentar nuevamente
</a>

</div>

</body>

</html>