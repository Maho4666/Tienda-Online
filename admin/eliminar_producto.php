<?php
session_start();
include("../includes/conexion.php");

if(!isset($_GET['id'])){
    header("Location: admin.php");
    exit();
}

$id = intval($_GET['id']);

// Obtener la imagen del producto
$sql = "SELECT imagen FROM productos WHERE id = $id";
$resultado = $conn->query($sql);

if($resultado->num_rows > 0){

    $producto = $resultado->fetch_assoc();

    if(!empty($producto['imagen'])){

        $ruta = "../imagenes/" . $producto['imagen'];

        if(file_exists($ruta)){
            unlink($ruta);
        }
    }
}

// Eliminar el producto
$sql = "DELETE FROM productos WHERE id = $id";

if($conn->query($sql)){

    echo "<script>
        alert('Producto eliminado correctamente');
        window.location='admin.php';
    </script>";

}else{

    echo "<script>
        alert('Error al eliminar el producto');
        window.location='admin.php';
    </script>";

}
?>