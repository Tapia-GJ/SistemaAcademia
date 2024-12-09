<?php
    include "../../config/db.php";

    if(isset($_POST['editEstudiante'])){
        $id = $_POST['id'];
        $Nombre_Estudiantes = $_POST['Nombre_Estudiantes'];
        $Apellido_Estudiantes = $_POST['apellido'];
        $Fecha_Nacimiento = $_POST['fecha_nacimiento']?? null;
        $Correo_Estudiantes = $_POST['email']?? null;
        $Telefono_Estudiantes = $_POST['telefono']?? null;
        $Direccion = $_POST['direccion']?? null;
        $Fecha_Registro = $_POST['fecha_registro']?? null;
        $Roles_Id_Roles = 3;
        $promedio_calificaciones = $_POST['promedio_calificaciones'] ?? null;


        $query = "UPDATE estudiantes SET Nombre_Estudiantes = '$Nombre_Estudiantes', Apellido_Estudiantes = '$Apellido_Estudiantes', Fecha_Nacimiento = '$Fecha_Nacimiento', Correo_Estudiantes = '$Correo_Estudiantes', Telefono_Estudiantes = '$Telefono_Estudiantes', Direccion = '$Direccion', Fecha_Registro = '$Fecha_Registro', Roles_Id_Roles = '$Roles_Id_Roles', promedio_calificaciones = '$promedio_calificaciones' WHERE Id_Estudiantes = $id";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Error al actualizar estudiante");
        }

        $_SESSION['mensaje'] = "Estudiante actualizado correctamente";
        $_SESSION["color"] = "green";
        $_SESSION["alert"] = "3";

        header(header: "Location: ../Pages/gestionEstudiantes.php");
    }

 
?>