<?php
include('../../config/db.php'); 
include "../../Config/config.php";

if (isset($_POST['saveAsis'])) {
    $fecha = $_POST['fecha'];
    $curso_id = $_POST['curso'];
    $estudiantes = isset($_POST['estudiantes']) ? $_POST['estudiantes'] : [];

    try {
        $queryAlt = "SELECT Id_Estudiantes from estudiantes";
        $result = mysqli_query($conn, $queryAlt);
        foreach ( $result as $stundent ) {
            $estudiante_id = $stundent["Id_Estudiantes"];

            $presente = in_array($estudiante_id, $estudiantes) ? 1 : 0;

            $query_insert = "INSERT INTO asistencia (Fecha_Asistencia, Presente, Estudiantes_Id_Estudiantes, Cursos_Id_Cursos) 
                      VALUES ('$fecha', $presente, '$estudiante_id', '$curso_id')";
            $insert_result = mysqli_query($conn, $query_insert);
            //para noombres de variables que tengan dos palabras se usa camel case, ese es el estandar ej: insertResult
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
}else if (isset($_POST['saveAsisProfe'])){
    $fecha = $_POST['fecha'];
    $curso_id = $_POST['curso'];
    $estudiantes = isset($_POST['estudiantes']) ? $_POST['estudiantes'] : [];

    try {
        foreach ($estudiantes as $estudiante_id) {
            $query = "INSERT INTO asistencia (Fecha_Asistencia, Presente, Estudiantes_Id_Estudiantes, Cursos_Id_Cursos) 
                      VALUES ('$fecha', 0, '$estudiante_id', '$curso_id')";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                throw new Exception("Error al registrar asistencia para el estudiante ID: $estudiante_id");
            }
        }

        $_SESSION['mensaje'] = "Asistencia registrada correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";

        header("Location: " . BASE_URL . "src/Pages/registroAsistenciasProfe.php");
    } catch (Exception $e) {
        $_SESSION['mensaje'] = "No se pudo registrar la asistencia: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/registroAsistenciasProfe.php");
    }
}
if(isset($_POST['editAsistencia'])){
    $id = $_POST['id'];
    $fecha = $_POST['Fecha_Asistencia'];
    $presente = isset($_POST['Presente']) && $_POST['Presente'] == "Asistencia" ? 1 : 0; 

    $query = "UPDATE asistencia SET Fecha_Asistencia = '$fecha', Presente = '$presente' WHERE Id_Asistencia = $id";
  
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Error al actualizar la asistencia");
    }

    $_SESSION['mensaje'] = "Asistencia actualizada correctamente";
    $_SESSION["color"] = "green";
    $_SESSION["alert"] = "3";

    header("Location: " . BASE_URL . "src/Pages/registroAsistencias.php");
}
?>
