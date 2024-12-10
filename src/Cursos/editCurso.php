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
    }elseif(isset($_POST["editCursoProfe"])){
        $id_Profe = $_POST['profesor'];
        $id_Curso = $_POST['Curso'];
        $profeAnterior = $_POST['profeAnterior'];
        $cursoAnterior = $_POST['cursoAnterior'];

        $query = "UPDATE profesores_cursos SET Profesores_Id_Profesores = '$id_Profe', Cursos_Id_Cursos = '$id_Curso' WHERE Profesores_Id_Profesores = $profeAnterior" and "Cursos_Id_Cursos = $cursoAnterior";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Error al actualizar la carga del profe");
        }

        $_SESSION['mensaje'] = "Carga actualizada correctamente";
        $_SESSION["color"] = "green";
        $_SESSION["alert"] = "3";
        header("Location: " . BASE_URL . "src/Pages/gestionCursos.php");

    }

 
?>