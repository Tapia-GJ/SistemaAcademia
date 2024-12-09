<?php
include "../../config/db.php";
include "../../Config/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = "DELETE FROM profesores WHERE Id_Profesores = $id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            throw new Exception("Error al eliminar al profesor:" . mysqli_error($conn));
        }

        $_SESSION['mensaje'] = "Profesor eliminado con éxito.";
        $_SESSION["color"] = "red";
        $_SESSION["alert"] = "2";

        header("Location: " . BASE_URL . "src/Pages/gestionProfesores.php");
    } catch (mysqli_sql_exception $e) {
        $_SESSION['mensaje'] = "No se pudo eliminar al Profesor: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/gestionProfesores.php");
        exit();
    }
}
?>