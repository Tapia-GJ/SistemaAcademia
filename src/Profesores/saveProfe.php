<?php
include "../../config/db.php";
include "../../Config/config.php";

if (isset($_POST['saveProfe'])) {
    $Nombre_Profesores = $_POST['nombre'];
    $Apellido_Profesores = $_POST['apellido'];
    $Correo = $_POST['email'] ?? null;
    $Telefono = $_POST['telefono'] ?? null;
    $Especialidad = $_POST['especialidad'] ?? null;
    $Fecha_Contratacion = $_POST['fecha_contratacion'] ?? null;
    $Roles_Id_Roles = 2;

    try {
        $query = "INSERT INTO `profesores`(`Nombre_Profesores`, `Apellido_Profesores`, `Correo_Profesores`, `Telefono_Profesores`, `Especialidad`, `Fecha_Contratacion`, `Roles_Id_Roles`) VALUES ('$Nombre_Profesores', '$Apellido_Profesores', '$Correo', '$Telefono', '$Especialidad', '$Fecha_Contratacion', '$Roles_Id_Roles')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            throw new Exception("Error al agregar al profesor:" . mysqli_error($conn));
        }

        $_SESSION['mensaje'] = "Profesor guardado correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";

        header(header: "Location: " . BASE_URL . "src/Pages/gestionProfesores.php");
    } catch (Exception $e) {
        $_SESSION['mensaje'] = "No se pudo agregar al Profesor: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/gestionProfesores.php");
        exit();
    }
}
?>