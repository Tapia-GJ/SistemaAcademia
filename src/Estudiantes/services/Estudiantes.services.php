<?php
class EstudiantesServices {
    private static $conn;

    public static function init($connection) {
        self::$conn = $connection;
    }

    public static function getAll(){
        $query = "SELECT * FROM estudiantes";
        $resultado = mysqli_query(self::$conn, $query);  
        $filas = array();
        while($fila = mysqli_fetch_array($resultado)){
            $filas[] = $fila;
        }
        return $filas;
    }

    public static function getById($id){
        $query = "SELECT * FROM estudiantes WHERE Id_Estudiantes = '$id'";
        $resultado = mysqli_query(self::$conn, $query);  
        $fila = mysqli_fetch_array($resultado);
        return $fila;
    }

    public static function create($nombre, $apellido, $fecha_nacimiento, $correo, $telefono, $direccion, $fecha_registro, $rol, $promedio_calificaciones){
        $query = "INSERT INTO estudiantes (Nombre_Estudiantes, Apellido_Estudiantes, Fecha_Nacimiento, Correo_Estudiantes, Telefono_Estudiantes, Direccion, Fecha_Registro, Roles_Id_Roles, promedio_calificaciones) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("sssssssis", $nombre, $apellido, $fecha_nacimiento, $correo, $telefono, $direccion, $fecha_registro, $rol, $promedio_calificaciones);
        $stmt->execute();
        $stmt->close();
    
        return self::getAll();
    }
 
    
    // public static function update($nombre, $apellido, $fecha_nacimiento, $correo, $telefono, $direccion, $fecha_registro, $rol, $promedio_calificaciones){
    //     $query = "UPDATE estudiantes SET Nombre_Estudiantes = '$nombre', Apellido_Estudiantes = '$apellido', Correo_Estudiantes = '$correo', Telefono_Estudiantes = '$telefono' WHERE Id_Estudiantes = '$id'";
    //     mysqli_query(self::$conn, $query);
    //     return self::getAll();
    // }

    public static function delete($id){
        $query = "DELETE FROM estudiantes WHERE Id_Estudiantes = '$id'";
        mysqli_query(self::$conn, $query);
        return self::getAll();
    }
}
?>
