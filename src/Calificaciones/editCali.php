<?php
include "../../config/db.php";
include "../../Config/config.php";

if (isset($_POST["editCali"])){
    $id = $_POST['id'];
    $idestudiante = $_POST["estudiante_id"];
    $idCurso = $_POST["curso_id"]; 
    $calificacion = $_POST["calificacion"];
    $fecha = date('Y-m-d');

    try { 
        $query = "UPDATE calificaciones SET Calificacion = '$calificacion', Fecha_Calificaciones = '$fecha', Estudiantes_Id_Estudiantes = '$idestudiante', Cursos_Id_Cursos = '$idCurso' WHERE Id_Calificaciones = $id";
        $result = mysqli_query($conn, $query);
        
        if (!$result) {
            // Capturar el error de MySQL y lanzarlo como una excepción
            throw new Exception("Error al editar una calificación: " . mysqli_error($conn));
        }
    
        $_SESSION['mensaje'] = "Calificación editada correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";
    
        header("Location: " . BASE_URL . "src/Pages/registroCalificaciones.php");
        exit();
    } catch (Exception $e) {
        // Capturar la excepción y almacenarla en la sesión
        $_SESSION['mensaje'] = "No se pudo editar la Calificación: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/registroCalificaciones.php");
        exit();
    }
}elseif(isset($_POST["editCaliProfe"])){
    $id = $_POST['id'];
    $idestudiante = $_POST["estudiante_id"];
    $idCurso = $_POST["curso_id"]; 
    $calificacion = $_POST["calificacion"];
    $fecha = date('Y-m-d');

    try {
        $query = "UPDATE calificaciones SET Calificacion = '$calificacion', Fecha_Calificaciones = '$fecha', Estudiantes_Id_Estudiantes = '$idestudiante', Cursos_Id_Cursos = '$idCurso' WHERE Id_Calificaciones = $id";
        $result = mysqli_query($conn, $query);
        
        if (!$result) {
            // Capturar el error de MySQL y lanzarlo como una excepción
            throw new Exception("Error al editar una calificación: " . mysqli_error($conn));
        }
    
        $_SESSION['mensaje'] = "Calificación editada correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";
    
        header("Location: " . BASE_URL . "src/Pages/registroCalificacionesProfe.php");
        exit();
    } catch (Exception $e) {
        // Capturar la excepción y almacenarla en la sesión
        $_SESSION['mensaje'] = "No se pudo editar la Calificación: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/registroCalificacionesProfe.php");
        exit();
    }
}
?>