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

/* FONDO */

body{

background:linear-gradient(180deg,#2dd4bf,#ffffff);

min-height:100vh;

display:flex;
justify-content:center;
align-items:flex-start;

padding:80px;

}

/* CONTENEDOR */

.container{

width:560px;

background:white;

padding:50px;

border-radius:24px;

box-shadow:0 25px 80px rgba(0,0,0,0.08);

}

/* HEADER */

.header{

display:flex;
justify-content:space-between;
align-items:center;

margin-bottom:40px;

}

/* TITULO */

.titulo{

font-size:40px;

background:linear-gradient(90deg,#06b6d4,#14b8a6,#3b82f6);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* INFO PRESTAMO */

.info{

background:#f8fafc;

border-radius:14px;

padding:18px;

margin-bottom:25px;

border:1px solid #eee;

}

.info p{

font-size:14px;

margin-bottom:6px;

color:#444;

}

/* LABEL */

label{

font-size:14px;

font-weight:500;

color:#555;

}

/* SELECT */

select{

width:100%;

padding:12px;

margin-top:8px;

border-radius:10px;

border:1px solid #ddd;

font-size:14px;

background:#fafafa;

transition:.25s;

}

select:focus{

outline:none;

border-color:#14b8a6;

box-shadow:0 0 0 2px rgba(20,184,166,0.15);

background:white;

}

/* BOTON */

button{

margin-top:30px;

width:100%;

padding:14px;

border:none;

border-radius:12px;

font-size:15px;

font-weight:500;

color:white;

cursor:pointer;

background:linear-gradient(90deg,#06b6d4,#14b8a6,#3b82f6);

transition:.25s;

}

button:hover{

transform:scale(1.03);

box-shadow:0 10px 30px rgba(0,0,0,0.15);

}

/* CONTENEDOR BOTONES */

.botones{

display:flex;
gap:15px;
margin-top:30px;

}

/* BOTON CANCELAR */

.cancelar{

flex:1;

text-align:center;

padding:14px;

border-radius:12px;

text-decoration:none;

background:#111;

color:white;

font-size:14px;

transition:.25s;

}

.cancelar:hover{

background:#333;

transform:scale(1.03);

}

/* BOTON PRINCIPAL */

button{

flex:1;

margin-top:0;

}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h1 class="titulo">Registrar devolución</h1>

</div>

<div class="info">

<p><b>Libro:</b> <?= $data['prestamo']['titulo'] ?></p>

<p><b>Ejemplar:</b> <?= $data['prestamo']['codigo_etiqueta'] ?></p>

<p><b>Condición al prestar:</b> <?= $data['prestamo']['condicion'] ?></p>

<p><b>Fecha límite:</b> <?= $data['prestamo']['fecha_limite'] ?></p>

</div>

<form method="POST" action="<?= BASE_URL ?>DevolucionController/devolver">

<input type="hidden" name="id_prestamo"
value="<?= $data['prestamo']['id_prestamo'] ?>">

<label>Condición al devolver</label>

<select name="condicion_devuelta">

<?php foreach($data['condiciones'] as $c): ?>

<option value="<?= $c['id_condicion'] ?>">
<?= $c['condicion'] ?>
</option>

<?php endforeach; ?>

</select>

<div class="botones">

<button type="submit">
Registrar devolución
</button>

<a class="cancelar" href="<?= BASE_URL ?>BibliotecarioController/prestamosActivos">
Cancelar
</a>

</div>

</form>

</div>

</body>

</html>