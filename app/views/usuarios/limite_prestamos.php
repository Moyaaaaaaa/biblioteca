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

display:flex;
justify-content:center;
align-items:center;

height:100vh;

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

background:linear-gradient(90deg,#6366f1,#06b6d4,#9333ea);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

p{

font-size:16px;

color:#444;

margin-bottom:30px;

}

.btn{

display:inline-block;

padding:12px 22px;

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

<h2>Límite alcanzado</h2>

<p>
Has alcanzado el número máximo de préstamos permitidos
(<?= $data['limite'] ?> libros).
</p>

<a class="btn" href="<?= BASE_URL ?>PrestamoController/misPrestamos">
Ver mis préstamos
</a>

</div>

</body>

</html>