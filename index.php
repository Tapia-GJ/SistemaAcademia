<?php
include "Config/db.php";
if (!isset($_SESSION['rol'])) {
    header('Location: login.php');
    exit;
}
$r = $_SESSION['rol'];
switch ($_SESSION['rol']) {
    case 1:
        header('Location: /src/Pages/IndexAdmin.php/$r');
        break;
    case 3:
        header('Location: /src/Pages/IndexAlum.php');
        break;
    case 2:
        header('Location: /src/Pages/IndexProfesores.php');
        break;
    default:
        echo "Rol no reconocido.";
        session_destroy();
        header('Location: /login.php/$r');
}
exit;
?>
