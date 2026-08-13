<?php
include("includes/conexion.php");

if(isset($_POST['registrar'])){

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $verificar = "SELECT * FROM usuarios WHERE correo='$correo'";
    $consulta = $conn->query($verificar);

    if($consulta->num_rows > 0){

        $error = "Este correo ya está registrado.";

    }else{

        $sql = "INSERT INTO usuarios(nombre, correo, password)
                VALUES('$nombre','$correo','$password')";

        if($conn->query($sql)){
            echo "<script>
                alert('Usuario registrado correctamente');
                window.location='login.php';
            </script>";
            exit();
        }else{
            $error = "Ocurrió un error al registrar el usuario.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Crear Cuenta</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#198754,#20c997);
    height:100vh;
}

.registro-card{
    max-width:450px;
    margin:auto;
    margin-top:50px;
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

<div class="card registro-card">

<div class="card-body p-4">

<div class="text-center">

<div class="logo">💻</div>

<h2 class="fw-bold">Crear Cuenta</h2>

<p class="text-muted">
Regístrate para comprar en nuestra tienda
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
Nombre completo
</label>

<input
type="text"
name="nombre"
class="form-control"
placeholder="Ingresa tu nombre"
required>

</div>

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
name="registrar"
class="btn btn-success btn-lg">

Crear Cuenta

</button>

</div>

</form>

<hr>

<div class="text-center">

¿Ya tienes una cuenta?

<br><br>

<a href="login.php" class="btn btn-outline-primary">

Iniciar Sesión

</a>

</div>

</div>

</div>

</div>

</body>

</html>