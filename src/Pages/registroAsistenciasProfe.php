<?php
include("../../config/db.php");
include("includes/headerProfe.php");

$action = $_GET['action'] ?? 'registro_asistencia';

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
                <h1 class="text-2xl font-bold">Gestión de Asistencia</h1>
                <div class="space-x-2">
                    
                    <a href="?action=registro_asistencia" class="bg-indigo-500 hover:bg-indigo-600 px-4 py-2 rounded">
                        Registrar Asistencia
                    </a>
                    <a href="?action=consulta_asistencia" class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded">
                        Consultar Asistencia
                    </a>
                </div>
            </div>

            <?php if ($action === 'registro_asistencia'): ?>
    <!-- Formulario de Registro de Asistencia -->
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4 text-blue-600">Registrar Asistencia</h2>
        <form method="POST" action="<?php echo BASE_URL; ?>src/Asistencia/saveAsis.php" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Fecha</label>
                <input type="date" name="fecha" required 
                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Curso</label>
                <select name="curso" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Seleccionar Cursos</option>
                    <?php
                    $query = "SELECT * FROM `cursos`";
                    $result = mysqli_query($conn, $query);
                    foreach ($result as $course):
                    ?>
                    <option value="<?=$course['Id_Cursos']?>"><?=$course['Nombre_Cursos']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Seleccionar Estudiantes</label>
                <div class="grid grid-cols-2 gap-2">
                    <?php 
                    $query = "SELECT * FROM `estudiantes`";
                    $result = mysqli_query($conn, $query);
                    foreach ($result as $student): ?>
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="estudiantes[]" 
                                   value="<?= $student['Id_Estudiantes'] ?>" 
                                   id="student_<?= $student['Id_Estudiantes'] ?>"
                                   class="mr-2">
                            <label for="student_<?= $student['Id_Estudiantes'] ?>">
                                <?= $student['Nombre_Estudiantes'] ?> <?= $student['Apellido_Estudiantes'] ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <button type="submit" name="saveAsis" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Registrar Asistencia
            </button>
        </form>
    </div>

            <?php elseif ($action === 'consulta_asistencia'): ?>
                <!-- Consulta de Asistencia -->
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-4 text-blue-600">Consulta de Asistencia</h2>
                    <table class="w-full border-collapse">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">Fecha</th>
                                <th class="px-4 py-2 text-left">Curso</th>
                                <th class="px-4 py-2 text-left">Estudiante</th>
                                <th class="px-4 py-2 text-left">Estado</th>
                                <th class="px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                $query = "SELECT t1.*, t2.*, t3.* 
                                          FROM asistencia as t1 
                                          INNER JOIN estudiantes as t2 ON t1.Estudiantes_Id_Estudiantes = t2.Id_Estudiantes 
                                          INNER JOIN cursos as t3 ON t1.Cursos_Id_Cursos = t3.Id_Cursos;";
                                $result = mysqli_query($conn, $query);
                                foreach ($result as $student):
                                $estatus = $student['Presente'] == 1 ? 'Asistencia' : 'Inasistencia'; 
                                ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2"><?= $student['Fecha_Asistencia'] ?></td>
                                        <td class="px-4 py-2"><?= $student['Nombre_Cursos'] ?></td>
                                        <td class="px-4 py-2">
                                            <?php echo $student['Nombre_Estudiantes'] . ' ' . $student['Apellido_Estudiantes']; ?>
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="<?= $student['Presente'] == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?> px-2 py-1 rounded">
                                                <?= $estatus ?>
                                            </span>
                                        </td>
                                        <td>
                                        <a href="?action=edit&id=<?= $fila['Id_Asistencia'] ?>"
                                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>