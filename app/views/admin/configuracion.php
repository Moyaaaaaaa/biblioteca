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

/* CONTENEDOR */

.container{

width:500px;

background:#f8f8fa;

padding:40px;

border-radius:20px;

box-shadow:0 15px 40px rgba(0,0,0,0.08);

}

/* TITULO */

h2{

font-size:36px;

margin-bottom:30px;

background:linear-gradient(90deg,#6366f1,#06b6d4,#9333ea);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* LABEL */

label{

font-weight:500;

color:#444;

}

/* INPUTS */

input{

width:100%;

padding:12px;

margin-top:8px;

border-radius:10px;

border:1px solid #ddd;

font-size:15px;

transition:.2s;

}

input:focus{

outline:none;

border-color:#6366f1;

box-shadow:0 0 8px rgba(99,102,241,0.2);

}

/* BOTON */

button{

margin-top:25px;

padding:12px 20px;

border:none;

border-radius:12px;

background:linear-gradient(90deg,#6366f1,#06b6d4);

color:white;

font-size:15px;

cursor:pointer;

transition:.3s;

}

button:hover{

transform:scale(1.05);

box-shadow:0 10px 25px rgba(0,0,0,0.15);

}

/* VOLVER */

.volver{

display:inline-block;

margin-top:25px;

padding:10px 18px;

border-radius:12px;

background:#111;

color:white;

text-decoration:none;

transition:.3s;

}

.volver:hover{

background:#333;

transform:scale(1.05);

}

</style>

</head>

<body>

<div class="container">

<h2>Configuración del Sistema</h2>

<form method="POST" action="<?= BASE_URL ?>AdminConfiguracionController/actualizar">

<label>Días de préstamo</label>
<br>

<input type="number"
name="dias_prestamo"
value="<?= $data['config']['dias_prestamo'] ?>">

<br><br>

<label>Monto multa por día</label>
<br>

<input type="number"
step="0.01"
name="multa_dia"
value="<?= $data['config']['multa_dia'] ?>">

<br>

<button type="submit">
Guardar configuración
</button>

</form>

<a class="volver" href="<?= BASE_URL ?>AdminController/index">
← Volver
</a>

</div>

</body>

</html>