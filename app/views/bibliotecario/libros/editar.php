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
background:#ffffff;
padding:80px;
display:flex;
justify-content:center;
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
margin-bottom:35px;

}

/* TITULO */

h2{

font-size:32px;

background:linear-gradient(90deg,#6366f1,#06b6d4,#9333ea);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* BOTON VOLVER */

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

/* LABEL */

label{

font-size:14px;

font-weight:500;

color:#333;

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

border-color:#6366f1;

box-shadow:0 0 0 2px rgba(99,102,241,0.15);

}

/* AUTORES */

.autores{

border:1px solid #ddd;

border-radius:10px;

padding:12px;

max-height:150px;

overflow:auto;

margin-top:10px;

}

.autores label{

display:block;

margin-bottom:6px;

font-size:13px;

color:#444;

}

/* BOTON */

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

background:linear-gradient(90deg,#6366f1,#06b6d4,#9333ea);

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

<h2>Editar Libro</h2>

<a class="volver" href="<?= BASE_URL ?>BibliotecarioLibroController/index">
← Volver
</a>

</div>

<form method="POST" action="<?= BASE_URL ?>BibliotecarioLibroController/actualizar">

<input type="hidden" name="id_libro" value="<?= $data['libro']['id_libro'] ?>">

<label>Título</label>
<input type="text" name="titulo" value="<?= $data['libro']['titulo'] ?>" required>

<br><br>

<label>ISBN</label>
<input type="text" name="isbn" value="<?= $data['libro']['isbn'] ?>" required>

<br><br>

<label>Año publicación</label>
<input type="number" name="anio_publicacion" value="<?= $data['libro']['anio_publicacion'] ?>" required>

<br><br>

<label>Categoría</label>

<select name="id_categoria">

<?php foreach($data['categorias'] as $categoria): ?>

<option value="<?= $categoria['id_categoria'] ?>"
<?php if($categoria['id_categoria']==$data['libro']['id_categoria']) echo "selected"; ?>>

<?= $categoria['categoria'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Editorial</label>

<select name="id_editorial">

<?php foreach($data['editoriales'] as $editorial): ?>

<option value="<?= $editorial['id_editorial'] ?>"
<?php if($editorial['id_editorial']==$data['libro']['id_editorial']) echo "selected"; ?>>

<?= $editorial['editorial'] ?>

</option>

<?php endforeach; ?>

</select>

<br><br>

<label>Autores</label>

<div class="autores">

<?php foreach($data['autores'] as $autor): ?>

<label>

<input type="checkbox"
name="autores[]"
value="<?= $autor['id_autor'] ?>"

<?php if(in_array($autor['id_autor'],$data['autoresLibro'])) echo "checked"; ?>

>

<?= $autor['nombre'] ?>
<?= $autor['apellido_paterno'] ?>
<?= $autor['apellido_materno'] ?>

</label>

<?php endforeach; ?>

</div>

<button type="submit">
Actualizar Libro
</button>

</form>

</div>

</body>

</html>