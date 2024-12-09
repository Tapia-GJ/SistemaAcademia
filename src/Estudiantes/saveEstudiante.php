<?php
include "../../config/db.php";

if(isset($_POST['saveEstudiante'])){
    $Nombre_Estudiantes = $_POST['nombre'];
    $Apellido_Estudiantes = $_POST['apellido'];
    $Fecha_Nacimiento = $_POST['fecha_nacimiento']?? null;
    $Correo_Estudiantes = $_POST['email']?? null;
    $Telefono_Estudiantes = $_POST['telefono']?? null;
    $Direccion = $_POST['direccion']?? null;
    $Fecha_Registro = $_POST['fecha_registro']?? null;
    $Roles_Id_Roles = 3;
    $promedio_calificaciones = $_POST['promedio_calificaciones'] ?? null;

    $query = "INSERT INTO estudiantes (Nombre_Estudiantes, Apellido_Estudiantes, Fecha_Nacimiento, Correo_Estudiantes, Telefono_Estudiantes, Direccion, Fecha_Registro, Roles_Id_Roles, promedio_calificaciones) VALUES ('$Nombre_Estudiantes', '$Apellido_Estudiantes', '$Fecha_Nacimiento', '$Correo_Estudiantes', '$Telefono_Estudiantes', '$Direccion', '$Fecha_Registro', '$Roles_Id_Roles', '$promedio_calificaciones')";
    $result = mysqli_query( $conn, $query );
    if(!$result){
        die("Error al insertar estudiante");
    }

    $_SESSION['mensaje'] = "Estudiante guardado correctamente";
    $_SESSION['color'] = "green";
    $_SESSION["alert"] = "3";

    header(header: "Location: ../Pages/gestionEstudiantes.php");
}
?>