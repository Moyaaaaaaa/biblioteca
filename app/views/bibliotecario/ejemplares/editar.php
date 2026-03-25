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

background:linear-gradient(180deg,#fff3b0,#ffffff);

min-height:100vh;

display:flex;
justify-content:center;
align-items:flex-start;

padding:80px;

}


.container{

width:520px;

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

background:linear-gradient(90deg,#f59e0b,#f97316,#ef4444);

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

border-color:#f59e0b;

box-shadow:0 0 0 2px rgba(245,158,11,0.15);

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

background:linear-gradient(90deg,#f59e0b,#f97316,#ef4444);

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

<h2>Editar Ejemplar</h2>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioEjemplarController/index">
← Volver
</a>

</div>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioEjemplarController/actualizar">

<input type="hidden" name="id_ejemplar" value="<?= $data['ejemplar']['id_ejemplar'] ?>">

<label>Libro</label>

<select name="id_libro">

<?php foreach($data['libros'] as $libro): ?>

<option value="<?= $libro['id_libro'] ?>"
<?php if($libro['id_libro'] == $data['ejemplar']['id_libro']) echo "selected"; ?>>

<?= $libro['titulo'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Código etiqueta</label>

<input 
type="text" 
name="codigo_etiqueta"
value="<?= $data['ejemplar']['codigo_etiqueta'] ?>"
required>

<br><br>

<label>Estado</label>

<select name="id_estado">

<?php foreach($data['estados'] as $estado): ?>

<option value="<?= $estado['id_estado'] ?>"
<?php if($estado['id_estado'] == $data['ejemplar']['id_estado']) echo "selected"; ?>>

<?= $estado['estado'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Condición</label>

<select name="id_condicion">

<?php foreach($data['condiciones'] as $condicion): ?>

<option value="<?= $condicion['id_condicion'] ?>"
<?php if($condicion['id_condicion'] == $data['ejemplar']['id_condicion']) echo "selected"; ?>>

<?= $condicion['condicion'] ?>

</option>

<?php endforeach; ?>

</select>

<button type="submit">
Actualizar Ejemplar
</button>

</form>

</div>

</body>

</html>