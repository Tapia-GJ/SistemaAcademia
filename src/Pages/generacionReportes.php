<?php
include("../../config/db.php");
include("includes/headerAdmin.php");

// Función para obtener estudiantes desde la base de datos
function getStudents($conn)
{
    $query = "SELECT * FROM estudiantes";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error al obtener estudiantes.");
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Funciones para generar reportes
function generateAcademicReport($students)
{
    // Informe de distribución de carreras
    $careerDistribution = array_count_values(array_column($students, 'Carrera'));

    // Cálculo de edad promedio
    $currentYear = date('Y');
    $ages = array_map(function ($student) use ($currentYear) {
        return $currentYear - date('Y', strtotime($student['Fecha_Nacimiento']));
    }, $students);

    $averageAge = count($ages) > 0 ? round(array_sum($ages) / count($ages), 2) : 0;

    return [
        'total_students' => count($students),
        'career_distribution' => $careerDistribution,
        'average_age' => $averageAge
    ];
}

function generateAdministrativeReport($students)
{
    // Informe de estudiantes por rango de edad
    $ageGroups = [
        '18-21' => 0,
        '22-25' => 0,
        '26-30' => 0,
        '31+' => 0
    ];

    $currentYear = date('Y');
    foreach ($students as $student) {
        $age = $currentYear - date('Y', strtotime($student['Fecha_Nacimiento']));

        if ($age >= 18 && $age <= 21) {
            $ageGroups['18-21']++;
        } elseif ($age >= 22 && $age <= 25) {
            $ageGroups['22-25']++;
        } elseif ($age >= 26 && $age <= 30) {
            $ageGroups['26-30']++;
        } else {
            $ageGroups['31+']++;
        }
    }

    return [
        'age_distribution' => $ageGroups
    ];
}

// Determinar la acción actual
$action = $_GET['action'] ?? 'list';

// Obtener estudiantes desde la base de datos
$students = getStudents($conn);
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
    <?php if ($action === 'list'): ?>
        <!-- Vista de Lista de Estudiantes -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                <h1 class="text-2xl font-bold">Lista de Estudiantes</h1>
                <div class="space-x-2">
                <a href="/src/Reporte/descargagen.php?type=pdf" 
                    class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded">
                    Reporte General
                </a>

                </div>
            </div>

            <table class="w-full">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Nombre</th>
            <th class="px-4 py-2 text-left">Apellido</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">Teléfono</th>
            <th class="px-4 py-2 text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2"><?= htmlspecialchars($student['Id_Estudiantes']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($student['Nombre_Estudiantes']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($student['Apellido_Estudiantes']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($student['Correo_Estudiantes']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($student['Telefono_Estudiantes']) ?></td>
                <td class="px-4 py-2 text-center">
                    <div class="flex justify-center space-x-2">
                        <!-- Botón Eliminar -->
                        <a href="<?= BASE_URL ?>src/Estudiantes/delete_task.php?id=<?= $student['Id_Estudiantes'] ?>&page=reporte"
                           onclick="return confirm('¿Estás seguro?')"
                           class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Eliminar
                        </a>
                        <!-- Botón Generar PDF -->
                        <a href="/src/Reporte/descarga.php?type=pdf&id=<?= $student['Id_Estudiantes'] ?>"
                           class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded">
                            Generar Reporte PDF
                        </a>
                    </div> 
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


    <?php elseif ($action === 'reports'): ?>
        <!-- Vista de Reportes -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-purple-600">Reportes</h2>

            <?php
            $academicReport = generateAcademicReport($students);
            $administrativeReport = generateAdministrativeReport($students);
            ?>

            <div class="mb-6">
                <h3 class="text-xl font-bold mb-4">Reporte Académico</h3>
                <ul class="list-disc pl-6">
                    <li>Total de Estudiantes: <?= $academicReport['total_students'] ?></li>
                    <li>Edad Promedio: <?= $academicReport['average_age'] ?> años</li>
                    <li>Distribución de Carreras:</li>
                    <ul class="pl-6">
                        <?php foreach ($academicReport['career_distribution'] as $career => $count): ?>
                            <li><?= $career ?>: <?= $count ?> estudiantes</li>
                        <?php endforeach; ?>
                    </ul>
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-bold mb-4">Reporte Administrativo</h3>
                <ul class="list-disc pl-6">
                    <li>Distribución por Rangos de Edad:</li>
                    <ul class="pl-6">
                        <?php foreach ($administrativeReport['age_distribution'] as $range => $count): ?>
                            <li><?= $range ?>: <?= $count ?> estudiantes</li>
                        <?php endforeach; ?>
                    </ul>
                </ul>
            </div>

            <div class="text-center">
                <a href="?action=list" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Volver a la Lista
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
