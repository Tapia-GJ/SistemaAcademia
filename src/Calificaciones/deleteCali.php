

<?php
include "../../config/db.php";
include "../../Config/config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM calificaciones WHERE Id_Calificaciones = $id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die ("Error al eliminar la calificación.");
    }

    $_SESSION['mensaje'] = "Calificación eliminada con éxito.";
    $_SESSION["color"] = "red";
    $_SESSION["alert"] = "2";

    header("Location: " . BASE_URL . "src/Pages/registroCalificaciones.php");
}
?>