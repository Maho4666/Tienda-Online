<?php
$host = "localhost";
$usuario = "root";
$password = "";
$bd = "tienda_online"; // Cambia a tiendaonline si luego renombramos la BD

$conn = new mysqli($host, $usuario, $password, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>