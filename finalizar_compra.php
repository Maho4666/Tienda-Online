<?php

session_start();

include("includes/conexion.php");


if(!isset($_SESSION['carrito']) || count($_SESSION['carrito']) == 0){

    header("Location: carrito.php");
    exit();

}


// Usuario que compra

$usuario = isset($_SESSION['usuario']) 
? $_SESSION['usuario'] 
: "Cliente";


$total = 0;


// Calcular total

foreach($_SESSION['carrito'] as $producto){

    $total += $producto['precio'];

}


// Guardar pedido

$sql = "INSERT INTO pedidos(usuario,total)
VALUES('$usuario','$total')";


if($conn->query($sql)){


    $pedido_id = $conn->insert_id;


    // Guardar detalle

    foreach($_SESSION['carrito'] as $producto){


        $nombre = $producto['nombre'];
        $precio = $producto['precio'];


        $sqlDetalle = "INSERT INTO detalle_pedido
        (pedido_id,producto,precio,cantidad)
        VALUES
        ('$pedido_id','$nombre','$precio','1')";


        $conn->query($sqlDetalle);


    }


    // Vaciar carrito

    unset($_SESSION['carrito']);


    echo "
    <script>
    alert('Compra realizada correctamente');
    window.location='index.php';
    </script>
    ";


}else{


    echo "Error al guardar la compra";


}


?>