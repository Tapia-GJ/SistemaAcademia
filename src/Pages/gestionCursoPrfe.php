<?php
include "../../config/db.php";
include "includes/headerProfe.php";
?>

    <div class="container mx-auto p-6">
        <!-- Vista de Lista de Cursos -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="bg-blue-500 text-white p-4">
                <h1 class="text-2xl font-bold">Lista de Cursos</h1>
            </div>
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Curso</th>
                        <th class="px-4 py-2 text-left">Profesor</th>
                        <th class="px-4 py-2 text-left">Creditos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = "SELECT t1.*, t2.*, t3.* FROM `profesores_cursos` as t1 INNER JOIN profesores as t2 on t1.Profesores_Id_Profesores = t2.Id_Profesores INNER JOIN cursos as t3 on t3.Id_Cursos = t1.Cursos_Id_Cursos;";
                    $result = mysqli_query($conn, $query);

                    foreach ($result as $course): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?= $course['Nombre_Cursos'] ?></td>
                            <td class="px-4 py-2"><?= $course['Nombre_Profesores']. ' '.$course['Apellido_Profesores'] ?></td>
                            <td class="px-4 py-2"><?= $course['Creditos'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
