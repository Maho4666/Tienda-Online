<?php
include("includes/conexion.php");
include("includes/header.php");

$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
}
?>

<div class="container mt-4">

    <h1 class="text-center mb-4">🖥️ Productos de Hardware</h1>

    <div class="row">

        <?php
        if($resultado->num_rows > 0){

            while($producto = $resultado->fetch_assoc()){
        ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow">

                <?php
                $imagen = !empty($producto['imagen'])
                    ? "imagenes/" . $producto['imagen']
                    : "imagenes/sin-imagen.jpg";
                ?>

                <img src="<?php echo $imagen; ?>" class="card-img-top" style="height:220px; object-fit:cover;">

                <div class="card-body">

                    <h5 class="card-title">
                        <?php echo $producto['nombre']; ?>
                    </h5>

                    <p class="card-text">
                        <?php echo $producto['descripcion']; ?>
                    </p>

                    <h4 class="text-success">
                        $<?php echo number_format($producto['precio'],2); ?>
                    </h4>

                    <p>
                        <strong>Stock:</strong>
                        <?php echo $producto['stock']; ?>
                    </p>

                    <a href="carrito.php?id=<?php echo $producto['id']; ?>" class="btn btn-primary w-100">
                        🛒 Agregar al carrito
                    </a>

                </div>

            </div>

        </div>

        <?php
            }

        }else{

            echo "<div class='alert alert-warning text-center'>No hay productos registrados.</div>";

        }
        ?>

    </div>

</div>

<?php
include("includes/footer.php");
?>