<?php
// Configuración de base de datos y lógica (simulada para el ejemplo)
$students = [
    ['id' => 1, 'nombre' => 'Juan', 'apellido' => 'Pérez', 'email' => 'juan@example.com', 'carrera' => 'Sistemas', 'fecha_nacimiento' => '2000-01-15'],
    ['id' => 2, 'nombre' => 'María', 'apellido' => 'García', 'email' => 'maria@example.com', 'carrera' => 'Derecho', 'fecha_nacimiento' => '1999-05-20']
];

// Funciones de generación de reportes
function generateAcademicReport($students)
{
    // Informe de distribución de carreras
    $careerDistribution = array_count_values(array_column($students, 'carrera'));

    // Cálculo de edad promedio
    $currentYear = date('Y');
    $ages = array_map(function ($student) use ($currentYear) {
        return $currentYear - date('Y', strtotime($student['fecha_nacimiento']));
    }, $students);
    $averageAge = round(array_sum($ages) / count($ages), 2);

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
        $age = $currentYear - date('Y', strtotime($student['fecha_nacimiento']));

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

// Procesamiento de formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';

    if ($action === 'create') {
        // Lógica de creación de estudiante (simulada)
        $newStudent = [
            'id' => count($students) + 1,
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'email' => $_POST['email'],
            'carrera' => $_POST['carrera'],
            'fecha_nacimiento' => $_POST['fecha_nacimiento']
        ];
        $students[] = $newStudent;
        // En un escenario real, esto se guardaría en la base de datos
    }

    if ($action === 'edit') {
        // Lógica de edición de estudiante (simulada)
        $id = intval($_POST['id']);
        foreach ($students as &$student) {
            if ($student['id'] === $id) {
                $student['nombre'] = $_POST['nombre'];
                $student['apellido'] = $_POST['apellido'];
                $student['email'] = $_POST['email'];
                $student['carrera'] = $_POST['carrera'];
                $student['fecha_nacimiento'] = $_POST['fecha_nacimiento'];
                break;
            }
        }
        // En un escenario real, esto se actualizaría en la base de datos
    }

    // Redirigir para prevenir reenvío de formulario
    header('Location: ?action=list');
    exit();
}

// Determinar la acción actual
$action = $_GET['action'] ?? 'list';

// Lógica de eliminación (simulada)
if ($action === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $students = array_filter($students, function ($student) use ($id) {
        return $student['id'] !== $id;
    });
    // En un escenario real, esto se eliminaría de la base de datos
    header('Location: ?action=list');
    exit();
}

// Seleccionar estudiante para edición
$editStudent = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $editStudent = array_filter($students, function ($student) use ($id) {
        return $student['id'] === $id;
    });
    $editStudent = reset($editStudent);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Estudiantes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
        <?php if ($action === 'list'): ?>
            <!-- Vista de Lista de Estudiantes -->
            <div class="bg-white shadow-md rounded-lg">
                <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                    <h1 class="text-2xl font-bold">Lista de Estudiantes</h1>
                    <div class="space-x-2">
                        <a href="?action=create" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded">
                            + Agregar Estudiante
                        </a>
                        <a href="?action=reports" class="bg-purple-500 hover:bg-purple-600 px-4 py-2 rounded">
                            Generar Reportes
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
                            <th class="px-4 py-2 text-left">Carrera</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2"><?= $student['id'] ?></td>
                                <td class="px-4 py-2"><?= $student['nombre'] ?></td>
                                <td class="px-4 py-2"><?= $student['apellido'] ?></td>
                                <td class="px-4 py-2"><?= $student['email'] ?></td>
                                <td class="px-4 py-2"><?= $student['carrera'] ?></td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="?action=edit&id=<?= $student['id'] ?>"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            Editar
                                        </a>
                                        <a href="?action=delete&id=<?= $student['id'] ?>"
                                            onclick="return confirm('¿Estás seguro?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($action === 'create'): ?>
            <!-- Formulario de Creación de Estudiante -->
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Nuevo Estudiante</h2>
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nombre</label>
                        <input type="text" name="nombre" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Apellido</label>
                        <input type="text" name="apellido" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Carrera</label>
                        <select name="carrera" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Seleccionar Carrera</option>
                            <option value="Sistemas">Ingeniería de Sistemas</option>
                            <option value="Derecho">Derecho</option>
                            <option value="Medicina">Medicina</option>
                            <option value="Administración">Administración</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <a href="?action=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>

        <?php elseif ($action === 'edit'): ?>
            <!-- Formulario de Edición de Estudiante -->
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Editar Estudiante</h2>
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="id" value="<?= $editStudent['id'] ?>">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nombre</label>
                        <input type="text" name="nombre" required
                            value="<?= $editStudent['nombre'] ?>"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Apellido</label>
                        <input type="text" name="apellido" required
                            value="<?= $editStudent['apellido'] ?>"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" required
                            value="<?= $editStudent['email'] ?>"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" required
                            value="<?= $editStudent['fecha_nacimiento'] ?>"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Carrera</label>
                        <select name="carrera" required
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Sistemas" <?= $editStudent['carrera'] == 'Sistemas' ? 'selected' : '' ?>>
                                Ingeniería de Sistemas
                            </option>
                            <option value="Derecho" <?= $editStudent['carrera'] == 'Derecho' ? 'selected' : '' ?>>
                                Derecho
                            </option>
                            <option value="Medicina" <?= $editStudent['carrera'] == 'Medicina' ? 'selected' : '' ?>>
                                Medicina
                            </option>
                            <option value="Administración" <?= $editStudent['carrera'] == 'Administración' ? 'selected' : '' ?>>
                                Administración
                            </option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <a href="?action=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Actualizar
                        </button>
                    </div>

                </form>
            </div>

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