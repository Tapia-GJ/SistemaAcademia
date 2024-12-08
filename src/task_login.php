<?php
include '../Config/db.php'; // Incluye la conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Consulta para buscar al usuario
    $query = "SELECT * FROM usuarios WHERE Nombre_Usuarios = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifica la contraseña
        if ($password === $user['Contrasena_Usuarios']) {
            $_SESSION['username'] = $user['Nombre_Usuarios'];
            $_SESSION['rol'] = $user['Roles_Id_Roles'];
            header('Location: ../index.php'); // Redirige después del login
            exit;
        } else {
            $_SESSION['mensaje'] = "Contraseña o usuario incorrecto.";
            header("Location: ../login.php"); exit;
        }
    } else {
        $_SESSION['mensaje'] = "Contraseña o usuario incorrecto.";
        header("Location: ../login.php"); exit;
    }
}
?>
