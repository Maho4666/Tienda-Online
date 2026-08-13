<?php
session_start();
include("../includes/conexion.php");

if(isset($_POST['guardar'])){

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $imagen = "";

    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0){

        $imagen = time() . "_" . $_FILES["imagen"]["name"];

        move_uploaded_file(
            $_FILES["imagen"]["tmp_name"],
            "../imagenes/" . $imagen
        );
    }

    $sql = "INSERT INTO productos(nombre, descripcion, precio, stock, imagen)
            VALUES('$nombre','$descripcion','$precio','$stock','$imagen')";

    if($conn->query($sql)){
        echo "<script>
            alert('Producto agregado correctamente');
            window.location='admin.php';
        </script>";
        exit();
    }else{
        echo "<div class='alert alert-danger'>".$conn->error."</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Agregar Producto</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>➕ Agregar Producto</h3>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label>Nombre</label>

<input
type="text"
name="nombre"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Descripción</label>

<textarea
name="descripcion"
class="form-control"
rows="4"
required></textarea>

</div>

<div class="row">

<div class="col-md-6">

<label>Precio</label>

<input
type="number"
step="0.01"
name="precio"
class="form-control"
required>

</div>

<div class="col-md-6">

<label>Stock</label>

<input
type="number"
name="stock"
class="form-control"
required>

</div>

</div>

<div class="mt-3">

<label>Imagen</label>

<input
type="file"
name="imagen"
class="form-control"
accept="image/*">

</div>

<div class="mt-4">

<button
type="submit"
name="guardar"
class="btn btn-success">

Guardar Producto

</button>

<a
href="admin.php"
class="btn btn-secondary">

Volver

</a>

</div>

</form>

</div>

</div>

</div>

</body>
</html>