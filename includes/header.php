<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tienda Online</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>


<body class="d-flex flex-column min-vh-100">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

<div class="container">


<a class="navbar-brand fw-bold" href="index.php">

🖥️ Tienda Online

</a>


<button class="navbar-toggler" 
type="button" 
data-bs-toggle="collapse" 
data-bs-target="#navbarMenu">

<span class="navbar-toggler-icon"></span>

</button>



<div class="collapse navbar-collapse" id="navbarMenu">


<ul class="navbar-nav ms-auto align-items-center">


<li class="nav-item">

<a class="nav-link" href="index.php">

🏠 Inicio

</a>

</li>



<li class="nav-item">

<a class="nav-link" href="productos.php">

💻 Productos

</a>

</li>



<li class="nav-item">

<a class="nav-link btn btn-warning text-dark ms-2 px-3" href="carrito.php">

🛒 Carrito

</a>

</li>



<?php if(isset($_SESSION['usuario'])){ ?>


<li class="nav-item ms-2">

<span class="text-white">

👤 <?php echo $_SESSION['usuario']; ?>

</span>

</li>


<li class="nav-item ms-2">

<a href="logout.php" class="btn btn-danger">

Cerrar sesión

</a>

</li>


<?php }else{ ?>


<li class="nav-item ms-2">

<a href="login.php" class="btn btn-light">

👤 Login

</a>

</li>


<li class="nav-item ms-2">

<a href="registro.php" class="btn btn-success">

Registro

</a>

</li>


<?php } ?>


</ul>


</div>


</div>

</nav>


<main class="flex-grow-1">