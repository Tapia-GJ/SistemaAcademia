<?php
// Configuración de base de datos y lógica (simulada para el ejemplo)
$students = [
    ['id' => 1, 'nombre' => 'Juan', 'apellido' => 'Pérez', 'email' => 'juan@example.com', 'carrera' => 'Sistemas', 'fecha_nacimiento' => '2000-01-15'],
    ['id' => 2, 'nombre' => 'María', 'apellido' => 'García', 'email' => 'maria@example.com', 'carrera' => 'Derecho', 'fecha_nacimiento' => '1999-05-20']
];

// Registro de asistencia simulado
$attendance_records = [];

// Determinar la acción actual
$action = $_GET['action'] ?? 'list';

// Procesar registro de asistencia
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registro_asistencia'])) {
    $fecha = $_POST['fecha'];
    $student_ids = $_POST['estudiantes'] ?? [];
    
    foreach ($student_ids as $student_id) {
        $attendance_records[] = [
            'fecha' => $fecha,
            'estudiante_id' => $student_id,
            'estado' => 'Presente'
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title> Registro de Asistencias- Academia Excelencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg">
            <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                <h1 class="text-2xl font-bold">Gestión de Asistencia</h1>
                <div class="space-x-2">
                    <a href="?action=list" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded">
                        Estudiantes
                    </a>
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
                    <form method="POST" class="space-y-4">
                        <input type="hidden" name="registro_asistencia" value="1">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Fecha</label>
                            <input type="date" name="fecha" required 
                                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Seleccionar Estudiantes</label>
                            <div class="grid grid-cols-2 gap-2">
                                <?php foreach ($students as $student): ?>
                                    <div class="flex items-center">
                                        <input type="checkbox" 
                                               name="estudiantes[]" 
                                               value="<?= $student['id'] ?>" 
                                               id="student_<?= $student['id'] ?>"
                                               class="mr-2">
                                        <label for="student_<?= $student['id'] ?>">
                                            <?= $student['nombre'] ?> <?= $student['apellido'] ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
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
                                <th class="px-4 py-2 text-left">Estudiante</th>
                                <th class="px-4 py-2 text-left">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($attendance_records)): ?>
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-gray-500">
                                        No hay registros de asistencia
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($attendance_records as $record): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2"><?= $record['fecha'] ?></td>
                                        <td class="px-4 py-2">
                                            <?php 
                                            $student = array_filter($students, function($s) use ($record) {
                                                return $s['id'] == $record['estudiante_id'];
                                            });
                                            $student = reset($student);
                                            echo $student['nombre'] . ' ' . $student['apellido'];
                                            ?>
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">
                                                <?= $record['estado'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>