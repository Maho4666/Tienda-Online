<?php
session_start();
include("../includes/conexion.php");

if(!isset($_GET['id'])){
    header("Location: admin.php");
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM productos WHERE id=$id";
$resultado = $conn->query($sql);

if($resultado->num_rows == 0){
    header("Location: admin.php");
    exit();
}

$producto = $resultado->fetch_assoc();

if(isset($_POST['actualizar'])){

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $imagen = $producto['imagen'];

    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0){

        $imagen = time() . "_" . basename($_FILES["imagen"]["name"]);

        move_uploaded_file(
            $_FILES["imagen"]["tmp_name"],
            "../imagenes/" . $imagen
        );
    }

    $sql = "UPDATE productos SET
            nombre='$nombre',
            descripcion='$descripcion',
            precio='$precio',
            stock='$stock',
            imagen='$imagen'
            WHERE id=$id";

    if($conn->query($sql)){

        echo "<script>
            alert('Producto actualizado correctamente');
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

<title>Editar Producto</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>✏️ Editar Producto</h3>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">Nombre</label>

<input
type="text"
name="nombre"
class="form-control"
value="<?php echo htmlspecialchars($producto['nombre']); ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Descripción</label>

<textarea
name="descripcion"
class="form-control"
rows="4"
required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>

</div>

<div class="row">

<div class="col-md-6">

<label class="form-label">Precio</label>

<input
type="number"
step="0.01"
name="precio"
class="form-control"
value="<?php echo $producto['precio']; ?>"
required>

</div>

<div class="col-md-6">

<label class="form-label">Stock</label>

<input
type="number"
name="stock"
class="form-control"
value="<?php echo $producto['stock']; ?>"
required>

</div>

</div>

<div class="mt-3">

<label class="form-label">Imagen actual</label><br>

<?php if(!empty($producto['imagen'])){ ?>

<img src="../imagenes/<?php echo $producto['imagen']; ?>"
width="120"
class="mb-3">

<?php } ?>

<input
type="file"
name="imagen"
class="form-control"
accept="image/*">

</div>

<div class="mt-4">

<button
type="submit"
name="actualizar"
class="btn btn-warning">

Actualizar Producto

</button>

<a
href="admin.php"
class="btn btn-secondary">

Cancelar

</a>

</div>

</form>

</div>

</div>

</div>

</body>

</html>