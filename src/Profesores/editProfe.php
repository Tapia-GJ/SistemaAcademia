<?php
include "../../config/db.php";
include "../../Config/config.php";

if (isset($_POST['editProfe'])) {
    $id = $_POST['id'];
    $Nombre_Profesores = $_POST['nombre'];
    $Apellido_Profesores = $_POST['apellido'];
    $Correo = $_POST['email'] ?? null;
    $Telefono = $_POST['telefono'] ?? null;
    $Especialidad = $_POST['especialidad'] ?? null;
    $Fecha_Contratacion = $_POST['fecha_contratacion'] ?? null;
    $Roles_Id_Roles = 2;

    try {
        $query = "UPDATE profesores SET Nombre_Profesores = '$Nombre_Profesores', Apellido_Profesores = '$Apellido_Profesores', Correo_Profesores = '$Correo', Telefono_Profesores = '$Telefono', Especialidad = '$Especialidad', Fecha_Contratacion = '$Fecha_Contratacion', Roles_Id_Roles = '$Roles_Id_Roles' WHERE Id_Profesores = $id";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            throw new Exception("Error al editar al profesor:" . mysqli_error($conn));
        }

        $_SESSION['mensaje'] = "Profesor guardado correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";

        header(header: "Location: " . BASE_URL . "src/Pages/gestionProfesores.php");
    } catch (Exception $e) {
        $_SESSION['mensaje'] = "No se pudieron editar los datos del Profesor: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/gestionProfesores.php");
        exit();
    }
}
?>