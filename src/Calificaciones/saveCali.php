<?php
include "../../config/db.php";
include "../../Config/config.php";

if (isset($_POST["saveCali"])){
    $idestudiante = $_POST["estudiante_id"];
    $idCurso = $_POST["curso_id"]; 
    $calificacion = $_POST["calificacion"];
    $fecha = date('Y-m-d');

    try {
        $query = "INSERT INTO calificaciones (Calificacion, Fecha_Calificaciones, Estudiantes_Id_Estudiantes, Cursos_Id_Cursos) VALUES ('$calificacion', '$fecha', '$idestudiante', '$idCurso')";
        $result = mysqli_query($conn, $query);
        
        if (!$result) {
            // Capturar el error de MySQL y lanzarlo como una excepción
            throw new Exception("Error al agregar una calificación: " . mysqli_error($conn));
        }
    
        $_SESSION['mensaje'] = "Calificación agregada correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";
    
        header("Location: " . BASE_URL . "src/Pages/registroCalificaciones.php");
        exit();
    } catch (Exception $e) {
        // Capturar la excepción y almacenarla en la sesión
        $_SESSION['mensaje'] = "No se pudo agregar la Calificación: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/registroCalificaciones.php");
        exit();
    }
}elseif(isset($_POST["saveCaliProfe"])){
    $idestudiante = $_POST["estudiante_id"];
    $idCurso = $_POST["curso_id"]; 
    $calificacion = $_POST["calificacion"];
    $fecha = date('Y-m-d');

    try {
        $query = "INSERT INTO calificaciones (Calificacion, Fecha_Calificaciones, Estudiantes_Id_Estudiantes, Cursos_Id_Cursos) VALUES ('$calificacion', '$fecha', '$idestudiante', '$idCurso')";
        $result = mysqli_query($conn, $query);
        
        if (!$result) {
            // Capturar el error de MySQL y lanzarlo como una excepción
            throw new Exception("Error al agregar una calificación: " . mysqli_error($conn));
        }
    
        $_SESSION['mensaje'] = "Calificación agregada correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";
    
        header("Location: " . BASE_URL . "src/Pages/registroCalificacionesProfe.php");
        exit();
    } catch (Exception $e) {
        // Capturar la excepción y almacenarla en la sesión
        $_SESSION['mensaje'] = "No se pudo agregar la Calificación: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/registroCalificacionesProfe.php");
        exit();
    }
}
?>