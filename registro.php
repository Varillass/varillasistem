<?php
require_once 'conexion.php';

$alert = '';

if (!empty($_POST)) {
    $tipo_usuario = mysqli_real_escape_string($conexion,$_POST['tipo_usuario']);
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
    $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios (tipo_usuario, usuario, clave) VALUES ('$tipo_usuario,$usuario', '$clave_encriptada')";

    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      El usuario se ha registrado correctamente.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Error al registrar el usuario.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
    }
    if ($resultado) {
        // Registro exitoso, redirigir al usuario a la página de inicio de sesión
        header('Location: index.php');
        exit;
    }
}

mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Registro de Usuario</h1>
        <?php echo $alert; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="clave">Contraseña:</label>
                <input type="password" class="form-control" id="clave" name="clave" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>