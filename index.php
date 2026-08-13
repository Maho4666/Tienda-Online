<?php
include("includes/conexion.php");
include("includes/header.php");

$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

?>


<div class="container mt-4">


<h2 class="text-center mb-4">
🖥️ Productos de Hardware
</h2>



<div class="row">


<?php

if($resultado->num_rows > 0){


while($producto = $resultado->fetch_assoc()){


?>


<div class="col-md-4 mb-4">


<div class="card h-100 shadow">



<img src="img/<?php echo $producto['imagen']; ?>"
class="card-img-top">



<div class="card-body">



<h5>

<?php echo htmlspecialchars($producto['nombre']); ?>

</h5>



<p>

<?php echo htmlspecialchars($producto['descripcion']); ?>

</p>



<p class="precio">

$<?php echo $producto['precio']; ?>

</p>



<p>

Stock:
<?php echo $producto['stock']; ?>

</p>



<a href="carrito.php?id=<?php echo $producto['id']; ?>"
class="btn btn-primary">

🛒 Agregar al carrito

</a>



</div>


</div>


</div>



<?php

}


}else{


?>

<div class="alert alert-warning text-center">

No hay productos registrados.

</div>


<?php

}


?>


</div>


</div>



<?php

include("includes/footer.php");

?>