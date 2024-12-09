<?php 
include "Config/config.php";
include "Config/db.php";

if (!isset($_SESSION['rol'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

$r = $_SESSION['rol'];
switch ($_SESSION['rol']) {
    case 1:
        header('Location: ' . BASE_URL . 'src/Pages/IndexAdmin.php');
        break;
    case 3:
        header('Location: ' . BASE_URL . 'src/Pages/IndexAlum.php');
        break;
    case 2:
        header('Location: ' . BASE_URL . 'src/Pages/IndexProfesores.php');
        break;
    default:
        echo "Rol no reconocido.";
        session_destroy();
        header('Location: ' . BASE_URL . 'login.php');
}
exit;
?>