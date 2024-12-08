<?php

session_start();

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "sistemaescolar"
);

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}
?>
