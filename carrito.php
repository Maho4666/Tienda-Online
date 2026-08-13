<?php

session_start();

include("includes/conexion.php");


// Agregar producto
if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $sql = "SELECT * FROM productos WHERE id=$id";
    $resultado = $conn->query($sql);

    if($resultado && $resultado->num_rows > 0){

        $producto = $resultado->fetch_assoc();

        if(!isset($_SESSION['carrito'])){
            $_SESSION['carrito'] = [];
        }

        $_SESSION['carrito'][] = $producto;
    }

    header("Location: carrito.php");
    exit();
}


// Eliminar producto
if(isset($_GET['eliminar'])){

    $indice = intval($_GET['eliminar']);

    unset($_SESSION['carrito'][$indice]);

    $_SESSION['carrito'] = array_values($_SESSION['carrito']);

    header("Location: carrito.php");
    exit();
}


include("includes/header.php");

?>


<div class="container mt-5">


<h2 class="text-center mb-4">
🛒 Carrito de Compras
</h2>


<?php

$total = 0;


if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0){

?>


<div class="card shadow">

<div class="card-body">


<table class="table table-hover">


<thead class="table-dark">

<tr>

<th>Producto</th>
<th>Precio</th>
<th>Acción</th>

</tr>

</thead>


<tbody>


<?php

foreach($_SESSION['carrito'] as $i=>$producto){

$total += $producto['precio'];

?>


<tr>

<td>
<?php echo $producto['nombre']; ?>
</td>


<td>
$<?php echo number_format($producto['precio'],2); ?>
</td>


<td>

<a href="carrito.php?eliminar=<?php echo $i; ?>"
class="btn btn-danger btn-sm">

🗑 Eliminar

</a>

</td>


</tr>


<?php } ?>


</tbody>

</table>



<div class="alert alert-success">

<h4>
Total:
$<?php echo number_format($total,2); ?>
</h4>

</div>



<div class="d-flex justify-content-between">


<a href="productos.php" class="btn btn-secondary">

⬅ Seguir comprando

</a>


<a href="finalizar_compra.php" class="btn btn-success">

🛒 Finalizar compra

</a>


</div>



</div>

</div>


<?php

}else{

?>


<div class="alert alert-warning text-center">

<h4>
El carrito está vacío
</h4>


<a href="productos.php" class="btn btn-primary">

Ver productos

</a>


</div>


<?php

}


?>


</div>


<?php

include("includes/footer.php");

?>