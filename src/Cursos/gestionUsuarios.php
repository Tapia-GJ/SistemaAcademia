<?php
include "../../config/db.php";
include "../../Config/config.php";

if (isset($_POST["saveUsuario"])) {
    $user = $_POST["user"];
    $password = $_POST["password"];
    $rol =  $_POST['rol'];
    $id = $_POST['id'] ?? null;

    try {
        if (empty($id)) {
            $id = null;
            $query = "INSERT INTO usuarios (Nombre_Usuarios, Contrasena_Usuarios, Roles_Id_Roles) VALUES ('$user', '$password', '$rol')";
        } else {
            $query = "Update usuarios set Nombre_Usuarios = '$user', Contrasena_Usuarios = '$password', Roles_Id_Roles = '$rol' where Id_Usuarios = '$id'";
        }
        $result = mysqli_query($conn, $query);

        if (!$result) {
            // Capturar el error de MySQL y lanzarlo como una excepción
            throw new Exception("Error al insertar datos : " . mysqli_error($conn));
        }

        $_SESSION['mensaje'] = "Profesor agregado a un curso correctamente";
        $_SESSION['color'] = "green";
        $_SESSION["alert"] = "3";

        header("Location: " . BASE_URL . "src/Pages/gestionUsuarios.php");
        exit();
    } catch (Exception $e) {
        // Capturar la excepción y almacenarla en la sesión
        $_SESSION['mensaje'] = "No se pudo agregar al curso: " . $e->getMessage();
        $_SESSION['color'] = "red";
        $_SESSION["alert"] = "2";
        header("Location: " . BASE_URL . "src/Pages/gestionUsuarios.php");
        exit();
    }

    // $query = "INSERT INTO profesores_cursos (Profesores_Id_Profesores, Cursos_Id_Cursos) VALUES ('$idProfe', '$idCurso')";
    // $result = mysqli_query( $conn, $query );
    // if(!$result){
    //     die("Error al agregar al profesor a un curso");
    // }


}
