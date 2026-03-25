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

background:linear-gradient(180deg,#c7e7ff,#ffffff);

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

margin-bottom:30px;

}

h2{

font-size:32px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d);

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

border-color:#2f80ed;

box-shadow:0 0 0 2px rgba(47,128,237,0.15);

}


h3{

font-size:16px;
color:#444;
margin-bottom:5px;

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

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d);

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

<h2>Agregar Ejemplar</h2>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioEjemplarController/index">
← Volver
</a>

</div>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioEjemplarController/guardar">

<?php if(!$data['id_libro']): ?>

<label>Libro</label>

<select name="id_libro" required>

<?php foreach($data['libros'] as $libro): ?>

<option value="<?= $libro['id_libro'] ?>">
<?= $libro['titulo'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<?php else: ?>

<h3>Libro</h3>

<strong>
<?= $data['libro']['titulo'] ?>
</strong>

<input type="hidden" name="id_libro" value="<?= $data['id_libro'] ?>">

<br><br>

<?php endif; ?>


<label>Edición</label>
<input type="text" name="edicion" required>

<br><br>

<label>Año de edición</label>
<input type="number" name="anio_edicion" required>

<br><br>

<label>Condición</label>

<select name="id_condicion" required>

<?php foreach($data['condiciones'] as $condicion): ?>

<option value="<?= $condicion['id_condicion'] ?>">
<?= $condicion['condicion'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Ubicación física</label>

<select name="id_ubicacion" required>

<?php foreach($data['ubicaciones'] as $ubicacion): ?>

<option value="<?= $ubicacion['id_ubicacion'] ?>">
<?= $ubicacion['ubicacion'] ?>
</option>

<?php endforeach; ?>

</select>

<button type="submit">
Guardar Ejemplar
</button>

</form>

</div>

</body>

</html>