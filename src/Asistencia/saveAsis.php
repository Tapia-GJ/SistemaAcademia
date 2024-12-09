<?php
include('../../config/db.php'); 
include "../../Config/config.php";

if (isset($_POST['saveAsis'])) {
    $fecha = $_POST['fecha'];
    $curso_id = $_POST['curso'];
    $estudiantes = isset($_POST['estudiantes']) ? $_POST['estudiantes'] : [];

    try {
        foreach ($estudiantes as $estudiante_id) {
            $query = "INSERT INTO asistencia (Fecha_Asistencia, Presente, Estudiantes_Id_Estudiantes, Cursos_Id_Cursos) 
                      VALUES ('$fecha', 1, '$estudiante_id', '$curso_id')";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                throw new Exception("Error al registrar asistencia para el estudiante ID: $estudiante_id");
            }
        }

        $_SESSION['mensaje'] = "Asistencia registrada correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";

        header("Location: " . BASE_URL . "src/Pages/registroAsistencias.php");
    } catch (Exception $e) {
        $_SESSION['mensaje'] = "No se pudo registrar la asistencia: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/registroAsistencias.php");
    }
}
?>
