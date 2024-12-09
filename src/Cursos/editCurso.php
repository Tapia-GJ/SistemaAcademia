<?php
include "../../config/db.php";
include "../../Config/config.php";

    if(isset($_POST['editCurso'])){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $creditos = $_POST['creditos']?? null;


        $query = "UPDATE cursos SET Nombre_Cursos = '$nombre', Descripcion = '$descripcion', Creditos = '$creditos' WHERE Id_Cursos = $id";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Error al actualizar el curso");
        }

        $_SESSION['mensaje'] = "Curso actualizado correctamente";
        $_SESSION["color"] = "green";
        $_SESSION["alert"] = "3";

        header("Location: " . BASE_URL . "src/Pages/gestionCursos.php");
    }

 
?>