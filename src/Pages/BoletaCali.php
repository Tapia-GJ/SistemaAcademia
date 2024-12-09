<?php
include "../../config/db.php";
include "includes/headerAlum.php";
?>

<!-- boleta -->
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-4">Listado de Calificaciones</h2>
                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left">Curso</th>
                            <th class="px-4 py-2 text-left">Estudiante</th>
                            <th class="px-4 py-2 text-left">Calificación</th>
                            <th class="px-4 py-2 text-left">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $query = "SELECT t1.*, t2.*, t3.*, t4.Nombre_Cursos FROM usuarios as t1 INNER JOIN estudiantes as t2 on t1.Estudiantes_Id = t2.Id_Estudiantes INNER JOIN calificaciones as t3 on t2.Id_Estudiantes = t3.Estudiantes_Id_Estudiantes INNER JOIN cursos as t4 on t4.Id_Cursos = t3.Cursos_Id_Cursos WHERE t1.Nombre_Usuarios = 'alum';";
                        $result = mysqli_query($conn, $query);
                        
                        foreach ($result as $fila): 
                            $estatus = $fila["Calificacion"] >= 7 ? 'Aprobado' : 'Reprobado';
                        ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 text-left"><?= $fila['Nombre_Cursos'] ?></td>
                                <td class="px-4 py-2 text-left"><?= $fila['Nombre_Estudiantes'] ?></td>
                                <td class="px-4 py-2 text-left"><?= $fila['Calificacion'] ?></td>
                                <td class="px-4 py-2 text-left">
                                    <span class="<?= $estatus == 'Aprobado' ? 'text-green-600' : 'text-red-600' ?>">
                                        <?= $estatus ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            
        </div>
    </div>
</body>
</html>
