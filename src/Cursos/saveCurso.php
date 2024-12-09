<?php
include "../../config/db.php";
include "../../Config/config.php";

if(isset($_POST['saveCurso'])){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $creditos = $_POST['creditos']?? null;

    $query = "INSERT INTO cursos (Nombre_Cursos, Descripcion, Creditos) VALUES ('$nombre', '$descripcion', '$creditos')";
    $result = mysqli_query( $conn, $query );
    if(!$result){
        die("Error al insertar curso");
    }

    $_SESSION['mensaje'] = "Curso guardado correctamente";
    $_SESSION['color'] = "green";
    $_SESSION["alert"] = "3";

    header("Location: " . BASE_URL . "src/Pages/gestionCursos.php");
}elseif (isset($_POST["saveCursoProfe"])){
    $idProfe = $_POST["profesor"];
    $idCurso = $_POST["Curso"]; 

    try {
        $query = "INSERT INTO profesores_cursos (Profesores_Id_Profesores, Cursos_Id_Cursos) VALUES ('$idProfe', '$idCurso')";
        $result = mysqli_query($conn, $query);
        
        if (!$result) {
            // Capturar el error de MySQL y lanzarlo como una excepción
            throw new Exception("Error al agregar al profesor a un curso: " . mysqli_error($conn));
        }
    
        $_SESSION['mensaje'] = "Profesor agregado a un curso correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";
    
        header("Location: " . BASE_URL . "src/Pages/gestionCursos.php");
        exit();
    } catch (Exception $e) {
        // Capturar la excepción y almacenarla en la sesión
        $_SESSION['mensaje'] = "No se pudo agregar al curso: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/gestionCursos.php");
        exit();
    }
    
    // $query = "INSERT INTO profesores_cursos (Profesores_Id_Profesores, Cursos_Id_Cursos) VALUES ('$idProfe', '$idCurso')";
    // $result = mysqli_query( $conn, $query );
    // if(!$result){
    //     die("Error al agregar al profesor a un curso");
    // }

    
}
?>