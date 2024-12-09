<?php
include "../../config/db.php";
include "../../Config/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM cursos WHERE Id_Cursos = $id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die ("Error al eliminar el curso.");
    }

    $_SESSION['mensaje'] = "Curso eliminado con éxito.";
    $_SESSION["color"] = "red";
    $_SESSION["alert"] = "2";

    header("Location: " . BASE_URL . "src/Pages/gestionCursos.php");
}
?>