<?php
session_start();
include("../includes/conexion.php");

// Si quieres restringir el acceso al administrador,
// descomenta estas líneas cuando tengas el rol funcionando.
/*
if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin'){
    header("Location: ../login.php");
    exit();
}
*/

$sql = "SELECT * FROM productos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Panel Administrador</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.navbar-brand{
    font-weight:bold;
}

img{
    border-radius:8px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<div class="container">

<a class="navbar-brand" href="../index.php">

🛒 Tienda Online - Administrador

</a>

<div>

<a href="../index.php" class="btn btn-outline-light">

Inicio

</a>

<a href="../login.php" class="btn btn-danger">

Cerrar sesión

</a>

</div>

</div>

</nav>

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Panel de Administración</h2>

<a href="agregar_producto.php" class="btn btn-success">

➕ Agregar Producto

</a>

</div>

<div class="card shadow">

<div class="card-body">

<table class="table table-striped table-hover align-middle">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Imagen</th>

<th>Nombre</th>

<th>Descripción</th>

<th>Precio</th>

<th>Stock</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php

if($resultado->num_rows > 0){

while($producto = $resultado->fetch_assoc()){

?>

<tr>

<td>

<?php echo $producto['id']; ?>

</td>

<td>

<?php

if(!empty($producto['imagen'])){

?>

<img
src="../imagenes/<?php echo $producto['imagen']; ?>"
width="70"
height="70"
style="object-fit:cover;">

<?php

}else{

echo "Sin imagen";

}

?>

</td>

<td>

<?php echo $producto['nombre']; ?>

</td>

<td>

<?php echo $producto['descripcion']; ?>

</td>

<td>

$<?php echo number_format($producto['precio'],2); ?>

</td>

<td>

<?php echo $producto['stock']; ?>

</td>

<td>

<a
href="editar_producto.php?id=<?php echo $producto['id']; ?>"
class="btn btn-warning btn-sm">

✏ Editar

</a>

<a
href="eliminar_producto.php?id=<?php echo $producto['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar este producto?');">

🗑 Eliminar

</a>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="7" class="text-center">

No existen productos registrados.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</div>

</body>

</html>