<?php
session_start();
include("includes/conexion.php");

if(isset($_POST['ingresar'])){

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE correo='$correo'";
    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0){

        $usuario = $resultado->fetch_assoc();

        if(password_verify($password, $usuario['password'])){

            $_SESSION['usuario'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];

            header("Location: index.php");
            exit();

        }else{

            $error = "Contraseña incorrecta.";

        }

    }else{

        $error = "El usuario no existe.";

    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Iniciar Sesión</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#0d6efd,#4facfe);
    height:100vh;
}

.login-card{
    max-width:420px;
    margin:auto;
    margin-top:70px;
    border:none;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.25);
}

.logo{
    font-size:70px;
}

</style>

</head>

<body>

<div class="container">

<div class="card login-card">

<div class="card-body p-4">

<div class="text-center">

<div class="logo">🛒</div>

<h2 class="fw-bold">Tienda Online</h2>

<p class="text-muted">
Inicia sesión para continuar
</p>

</div>

<?php
if(isset($error)){
?>
<div class="alert alert-danger">
<?php echo $error; ?>
</div>
<?php
}
?>

<form method="POST">

<div class="mb-3">

<label class="form-label">
Correo electrónico
</label>

<input
type="email"
name="correo"
class="form-control"
placeholder="correo@ejemplo.com"
required>

</div>

<div class="mb-3">

<label class="form-label">
Contraseña
</label>

<input
type="password"
name="password"
class="form-control"
placeholder="********"
required>

</div>

<div class="d-grid">

<button
type="submit"
name="ingresar"
class="btn btn-primary btn-lg">

Iniciar Sesión

</button>

</div>

</form>

<hr>

<div class="text-center">

¿No tienes cuenta?

<br><br>

<a href="registro.php" class="btn btn-outline-success">

Crear Cuenta

</a>

</div>

</div>

</div>

</div>

</body>

</html>