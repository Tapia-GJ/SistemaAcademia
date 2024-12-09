<?php
include("../../config/db.php");
include("includes/headerAdmin.php");

// Determinar la acción actual
$action = $_GET['action'] ?? 'list_grades';
?> 
<div class="container mx-auto px-6">
    <?php if (isset($_SESSION['mensaje'])) { ?>
        <div id="alert-border-<?= $_SESSION['alert'] ?>"
            class="flex items-center p-4 mb-4 text-<?= $_SESSION['color'] ?>-800 border-t-4 border-<?= $_SESSION['color'] ?>-300 bg-<?= $_SESSION['color'] ?>-50 dark:text-<?= $_SESSION['color'] ?>-400 dark:bg-gray-100 dark:border-<?= $_SESSION['color'] ?>-500"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div class="ms-3 text-sm font-medium">
                <?= $_SESSION['mensaje']; ?>
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white bg-opacity-80 text-<?= $_SESSION['color'] ?>-500 rounded-lg focus:ring-2 focus:ring-<?= $_SESSION['color'] ?>-400 p-1.5 hover:bg-<?= $_SESSION['color'] ?>-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-100 dark:text-<?= $_SESSION['color'] ?>-400 dark:hover:bg-gray-200"
                data-dismiss-target="#alert-border-<?= $_SESSION['alert'] ?>" aria-label="Close">
                <span class="sr-only">Dismiss</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        <?php unset($_SESSION['mensaje']);
    } ?>
</div>
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg">
        <div class="flex justify-between items-center bg-blue-500 text-white p-4">
            <h1 class="text-2xl font-bold">Gestión de Calificaciones</h1>
            <div class="space-x-2">
                <a href="?action=list_grades" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">
                    Listar Calificaciones
                </a>
                <a href="?action=add_grade" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">
                    + Agregar Calificación
                </a>
            </div>
        </div>

        <?php if ($action === 'list_grades'): ?>
            <!-- Vista de Calificaciones -->
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-4">Listado de Calificaciones</h2>
                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left">Curso</th>
                            <th class="px-4 py-2 text-left">Estudiante</th>
                            <th class="px-4 py-2 text-left">Nota Final</th>
                            <th class="px-4 py-2 text-left">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT t1.*, t2.*, t3.* FROM calificaciones as t1 INNER JOIN cursos as t2 on t1.Cursos_Id_Cursos = t2.Id_Cursos INNER JOIN estudiantes as t3 on t1.Estudiantes_Id_Estudiantes = t3.Id_Estudiantes;";
                        $result = mysqli_query($conn, $query);
                        foreach ($result as $fila):
                            $estatus = $fila["Calificacion"] >= 7 ? 'Aprobado' : 'Reprobado';
                            ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2"><?php echo $fila['Nombre_Cursos'] ?></td>
                                <td class="px-4 py-2"><?= $fila['Nombre_Estudiantes'] ?>         <?= $fila['Apellido_Estudiantes'] ?></td>
                                <td class="px-4 py-2"><?php echo $fila['Calificacion'] ?></td>
                                <td class="px-4 py-2">
                                    <span class="<?= $estatus == 'Aprobado' ? 'text-green-600' : 'text-red-600' ?>">
                                        <?= $estatus ?>
                                    </span>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        <?php elseif ($action === 'add_grade'): ?>
            <!-- Formulario de Agregar Calificación -->
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Registrar Calificación</h2>
                <form method="POST" action="<?php echo BASE_URL; ?>src/Calificaciones/saveCali.php" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Curso</label>
                        <select name="curso_id" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Seleccionar Curso</option>
                            <?php
                            $query = "SELECT * FROM `cursos`";
                            $result = mysqli_query($conn, $query);
                            foreach ($result as $course):
                                ?>
                                <option value="<?= $course['Id_Cursos'] ?>"><?= $course['Nombre_Cursos'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Estudiante</label>
                        <select name="estudiante_id" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Seleccionar Estudiante</option>
                            <?php
                        $query = "SELECT * FROM `estudiantes`";
                        $result = mysqli_query($conn, $query);
                        foreach ($result as $course):
                        ?>
                        <option value="<?=$course['Id_Estudiantes']?>"><?=$course['Nombre_Estudiantes']?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nota Final</label>
                        <input type="number" name="calificacion" step="0.1" required min="0" max="10"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="">
                    </div>
                    <div class="flex justify-between">
                        <a href="?action=list_grades" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" name="saveCali" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Guardar Calificación
                        </button>
                    </div>
                </form>
            </div>


        <?php endif; ?>
    </div>
</div>
</body>

</html>