<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Login Biblioteca</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

<!-- Icons -->
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
height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

/* contenedor */

.login-container{

width:380px;
padding:40px;
border-radius:12px;
border:1px solid #eee;
box-shadow:0 10px 25px rgba(0,0,0,0.05);
text-align:center;

}

/* titulo */

.login-title{

font-size:28px;
font-weight:600;
margin-bottom:30px;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

}

/* inputs */

.input-group{

position:relative;
margin-bottom:20px;

}

.input-group i{

position:absolute;
left:12px;
top:50%;
transform:translateY(-50%);
color:black;

}

input{

width:100%;
padding:12px 12px 12px 38px;
border:1px solid #ddd;
border-radius:8px;
font-size:14px;

}

input:focus{

outline:none;
border-color:#7b2ff7;

}

/* boton */

button{

width:100%;
padding:12px;
border:none;
border-radius:8px;
font-size:15px;
font-weight:500;
cursor:pointer;
color:white;

background:linear-gradient(90deg,#2f80ed,#7b2ff7,#ff4d6d,#ff7a18);

}

button:hover{

opacity:0.9;

}

/* footer */

.login-footer{

margin-top:20px;
font-size:13px;
color:#666;

}

</style>

</head>


<body>

<div class="login-container">

<h1 class="login-title">
Biblioteca
</h1>

<form method="POST" action="<?= BASE_URL ?>AuthController/autenticar">

<div class="input-group">

<i class="fa fa-user"></i>

<input 
type="text" 
name="username"
placeholder="Usuario"
required>

</div>


<div class="input-group">

<i class="fa fa-lock"></i>

<input 
type="password" 
name="contrasenia"
placeholder="Contraseña"
required>

</div>


<button type="submit">
Iniciar sesión
</button>

</form>

<div class="login-footer">
Sistema de gestión bibliotecaria
</div>

</div>

</body>

</html>