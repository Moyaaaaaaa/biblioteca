<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Mis Multas</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Montserrat',sans-serif;
}

body{

background:#0f0f0f;
color:white;
padding:60px;

}

/* titulo */

h2{

font-size:36px;
margin-bottom:40px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* grid */

.multas-grid{

display:grid;
grid-template-columns:repeat(auto-fill,minmax(320px,1fr));
gap:25px;

}

/* card */

.multa-card{

background:#181818;
border-radius:14px;
padding:25px;

border:1px solid #2a2a2a;

transition:all .25s;

}

/* animacion */

.multa-card:hover{

transform:translateY(-5px);
box-shadow:0 10px 25px rgba(0,0,0,0.5);

}

/* icono */

.icono{

font-size:26px;
margin-bottom:10px;

}

/* titulo libro */

.libro{

font-size:18px;
font-weight:600;
margin-bottom:12px;

}

/* info */

.info{

font-size:14px;
color:#ccc;
margin-bottom:6px;

}

/* estado */

.estado{

margin-top:10px;
display:inline-block;
padding:6px 12px;
border-radius:6px;
font-size:12px;

}

/* pendiente */

.pendiente{

background:linear-gradient(90deg,#ff4d6d,#ff7a18);
color:white;

}

/* pagada */

.pagada{

background:#2ecc71;
color:white;

}

/* volver */

.volver{

margin-top:50px;
display:inline-block;
text-decoration:none;
color:white;
font-size:14px;

}

.volver:hover{

text-decoration:underline;

}

</style>

</head>


<body>

<h2>Mis Multas</h2>

<div class="multas-grid">

<?php foreach($data['multas'] as $m): ?>

<div class="multa-card">

<div class="icono">
<i class="fa fa-money-bill-wave"></i>
</div>

<div class="libro">
<?= $m['titulo'] ?>
</div>

<div class="info">
Motivo: <?= $m['motivos'] ?>
</div>

<div class="info">
Monto: $<?= $m['monto_total'] ?>
</div>

<?php if($m['pagada']==0): ?>

<span class="estado pendiente">
Pendiente
</span>

<?php else: ?>

<span class="estado pagada">
Pagada
</span>

<?php endif; ?>

</div>

<?php endforeach; ?>

</div>


<a class="volver" href="<?= BASE_URL ?>DashboardController/index">
← Volver
</a>

</body>

</html>