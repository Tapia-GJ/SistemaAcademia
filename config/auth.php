<?php
function checkAccess($allowedRoles) {
    session_start();
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $allowedRoles)) {
        header('Location: /login.php');
        exit;
    }
}
?>
