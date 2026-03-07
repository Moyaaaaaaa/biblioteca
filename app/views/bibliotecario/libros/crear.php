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

/* FONDO */

body{

background:linear-gradient(180deg,#c7e7ff,#ffffff);

min-height:100vh;

display:flex;
justify-content:center;
align-items:flex-start;

padding:80px;

}

/* CONTENEDOR */

.container{

width:520px;

background:white;

padding:40px;

border-radius:20px;

box-shadow:0 20px 50px rgba(0,0,0,0.08);

}

/* HEADER */

.header{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:30px;

}

/* TITULO */

h2{

font-size:32px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* BOTON VOLVER */

.volver{

text-decoration:none;

padding:10px 18px;

border-radius:10px;

background:black;

color:white;

font-size:13px;

transition:.25s;

}

.volver:hover{

transform:translateY(-2px);

box-shadow:0 8px 20px rgba(0,0,0,0.2);

}

/* LABEL */

label{

font-size:14px;

font-weight:500;

color:#444;

}

/* INPUTS */

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

/* AUTORES */

.autores{

border:1px solid #ddd;

border-radius:10px;

padding:12px;

max-height:160px;

overflow-y:auto;

margin-top:10px;

}

.autores label{

display:block;

margin-bottom:6px;

font-size:13px;

color:#333;

}

/* BOTON */

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

/* TEXTO */

small{

font-size:12px;

color:#777;

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h2>Agregar Libro</h2>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioLibroController/index">
← Volver
</a>

</div>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioLibroController/guardar">

<label>Título</label>
<input type="text" name="titulo" required>

<br><br>

<label>ISBN</label>
<input type="text" name="isbn" required>

<br><br>

<label>Año de publicación</label>
<input type="number" name="anio_publicacion" required>

<br><br>

<label>Categoría</label>

<select name="id_categoria" required>

<?php foreach($data['categorias'] as $categoria): ?>

<option value="<?= $categoria['id_categoria'] ?>">
<?= $categoria['categoria'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Editorial</label>

<select name="id_editorial" required>

<?php foreach($data['editoriales'] as $editorial): ?>

<option value="<?= $editorial['id_editorial'] ?>">
<?= $editorial['editorial'] ?>
</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Autores</label>
<br>
<small>Puede seleccionar uno o varios autores</small>

<div class="autores">

<?php foreach($data['autores'] as $autor): ?>

<label>

<input type="checkbox" name="autores[]" value="<?= $autor['id_autor'] ?>">

<?= $autor['nombre'] ?>
<?= $autor['apellido_paterno'] ?>
<?= $autor['apellido_materno'] ?>

</label>

<?php endforeach; ?>

</div>

<button type="submit">
Guardar Libro
</button>

</form>

</div>

</body>

</html>