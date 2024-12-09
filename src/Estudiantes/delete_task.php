<?php
include "../../config/db.php";
include "../../Config/config.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitiza el ID para evitar inyecciones
    $query = "DELETE FROM estudiantes WHERE Id_Estudiantes = $id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error al eliminar estudiante.");
    }

    // Mensajes para la sesión
    $_SESSION['mensaje'] = "Estudiante eliminado con éxito.";
    $_SESSION["color"] = "red";
    $_SESSION["alert"] = "2";

    // Redirección basada en el parámetro 'page'
    if (isset($_GET["page"]) && $_GET["page"] === "reporte") {
        header("Location: " . BASE_URL . "src/Pages/generacionReportes.php");
        exit(); // Detenemos el script después de la redirección
    }

    // Redirección predeterminada
    header("Location: " . BASE_URL . "src/Pages/gestionEstudiantes.php");
    exit(); // Detenemos el script después de la redirección
}
?>
