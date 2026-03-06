<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Panel Usuario</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Montserrat',sans-serif;
}

body{
background:white;
padding:60px;
}

/* header */

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:60px;
}

.header h1{

font-size:32px;
font-weight:600;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

.logout{
text-decoration:none;
color:black;
font-size:14px;
}

/* icon grid */

.menu-grid{

display:flex;
gap:40px;
margin-bottom:80px;

}

.menu-item{

font-size:40px;
cursor:pointer;
color:black;
transition:all .3s;

}

.menu-item:hover{

transform:translateY(-5px) scale(1.05);

}

/* text section */

.feature-text{

max-width:600px;
margin-left:auto;
text-align:right;

opacity:0;
transform:translateY(20px);
transition:all .4s;

}

.feature-text.active{

opacity:1;
transform:translateY(0);

}

.feature-title{

font-size:60px;
font-weight:700;
line-height:1.1;
margin-bottom:20px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

.feature-desc{

font-size:18px;
color:#666;
line-height:1.6;

}

</style>

</head>


<body>


<div class="header">

<h1>
Bienvenido <?= $_SESSION['usuario']['nombre'] ?>
</h1>

<a class="logout" href="<?= BASE_URL ?>AuthController/logout">
Cerrar sesión
</a>

</div>



<!-- ICONOS -->

<div class="menu-grid">

<a href="<?= BASE_URL ?>LibroController/catalogo">
<i class="fa fa-book menu-item"
data-title="Explora el catálogo."
data-desc="Descubre todos los libros disponibles en la biblioteca."
></i>
</a>


<a href="<?= BASE_URL ?>PrestamoController/misPrestamos">
<i class="fa fa-book-open menu-item"
data-title="Tus préstamos."
data-desc="Consulta los libros que tienes actualmente prestados."
></i>
</a>


<a href="<?= BASE_URL ?>NotificacionController/index">
<i class="fa fa-bell menu-item"
data-title="Notificaciones."
data-desc="Mantente informado sobre recordatorios y avisos."
></i>
</a>


<a href="<?= BASE_URL ?>MultaController/misMultas">
<i class="fa fa-money-bill menu-item"
data-title="Gestión de multas."
data-desc="Consulta multas pendientes o pagadas."
></i>
</a>


<a href="<?= BASE_URL ?>CategoriaController/index">
<i class="fa fa-folder menu-item"
data-title="Explora categorías."
data-desc="Encuentra libros organizados por categoría."
></i>
</a>


<a href="<?= BASE_URL ?>AutorController/index">
<i class="fa fa-user-pen menu-item"
data-title="Autores."
data-desc="Descubre libros según sus autores."
></i>
</a>

</div>



<!-- TEXTO GRANDE -->

<div id="feature" class="feature-text">

<div id="title" class="feature-title">
Bienvenido.
</div>

<div id="desc" class="feature-desc">
Selecciona una opción del menú para comenzar.
</div>

</div>



<script>

const items=document.querySelectorAll(".menu-item");
const feature=document.getElementById("feature");
const title=document.getElementById("title");
const desc=document.getElementById("desc");

items.forEach(item=>{

item.addEventListener("mouseenter",()=>{

title.textContent=item.dataset.title;
desc.textContent=item.dataset.desc;

feature.classList.add("active");

});

});

</script>


</body>

</html>