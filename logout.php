<?php
include "config/config.php";
// Destruye la sesión
session_unset();
session_destroy();

// Redirige al inicio de sesión
header('Location: /home.php');
exit;
?>
 