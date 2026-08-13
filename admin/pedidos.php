<?php

session_start();

include("../includes/conexion.php");


// Verificar administrador

if(!isset($_SESSION['usuario']) || $_SESSION['rol'] != "admin"){

    header("Location: ../login.php");
    exit();

}


$sql = "SELECT * FROM pedidos ORDER BY fecha DESC";

$resultado = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Pedidos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-light">


<div class="container mt-5">


<h2 class="mb-4">
📦 Pedidos realizados
</h2>


<div class="card shadow">


<div class="card-body">


<table class="table table-striped">


<thead class="table-dark">

<tr>

<th>ID</th>
<th>Cliente</th>
<th>Fecha</th>
<th>Total</th>
<th>Estado</th>

</tr>

</thead>


<tbody>


<?php


if($resultado->num_rows > 0){


while($pedido = $resultado->fetch_assoc()){


?>


<tr>

<td>
<?php echo $pedido['id']; ?>
</td>


<td>
<?php echo $pedido['usuario']; ?>
</td>


<td>
<?php echo $pedido['fecha']; ?>
</td>


<td>
$<?php echo $pedido['total']; ?>
</td>


<td>

<span class="badge bg-warning">

<?php echo $pedido['estado']; ?>

</span>

</td>


</tr>


<?php

}

}else{


echo "
<tr>
<td colspan='5' class='text-center'>
No existen pedidos todavía
</td>
</tr>
";


}


?>


</tbody>


</table>


<a href="admin.php" class="btn btn-secondary">

⬅ Volver

</a>


</div>

</div>


</div>


</body>

</html>