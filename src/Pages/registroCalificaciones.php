<?php
// Configuración de base de datos y lógica (simulada para el ejemplo)
$courses = [
    ['id' => 1, 'nombre' => 'Introducción a la Programación', 'codigo' => 'SIS101', 'creditos' => 4, 'profesor' => 'Juan Pérez', 'carrera' => 'Sistemas'],
    ['id' => 2, 'nombre' => 'Derecho Constitucional', 'codigo' => 'DER201', 'creditos' => 3, 'profesor' => 'María García', 'carrera' => 'Derecho']
];

// Simulación de estudiantes
$students = [
    ['id' => 1, 'nombre' => 'Carlos Mendoza', 'carrera' => 'Sistemas'],
    ['id' => 2, 'nombre' => 'Ana López', 'carrera' => 'Derecho']
];

// Simulación de calificaciones
$grades = [
    ['curso_id' => 1, 'estudiante_id' => 1, 'parcial1' => 85, 'parcial2' => 90, 'final' => 87.5],
    ['curso_id' => 1, 'estudiante_id' => 2, 'parcial1' => 75, 'parcial2' => 80, 'final' => 77.5],
    ['curso_id' => 2, 'estudiante_id' => 1, 'parcial1' => 88, 'parcial2' => 92, 'final' => 90],
    ['curso_id' => 2, 'estudiante_id' => 2, 'parcial1' => 82, 'parcial2' => 85, 'final' => 83.5]
];

// Determinar la acción actual
$action = $_GET['action'] ?? 'list_grades';
$curso_id = $_GET['curso_id'] ?? null;
$estudiante_id = $_GET['estudiante_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Calificaciones - Academia Excelencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
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
                                <th class="px-4 py-2 text-center">Parcial 1</th>
                                <th class="px-4 py-2 text-center">Parcial 2</th>
                                <th class="px-4 py-2 text-center">Nota Final</th>
                                <th class="px-4 py-2 text-center">Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grades as $grade): 
                                $curso = array_filter($courses, function($c) use ($grade) { 
                                    return $c['id'] == $grade['curso_id']; 
                                });
                                $estudiante = array_filter($students, function($s) use ($grade) { 
                                    return $s['id'] == $grade['estudiante_id']; 
                                });
                                $curso = reset($curso);
                                $estudiante = reset($estudiante);
                                $estatus = $grade['final'] >= 70 ? 'Aprobado' : 'Reprobado';
                            ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2"><?= $curso['nombre'] ?></td>
                                    <td class="px-4 py-2"><?= $estudiante['nombre'] ?></td>
                                    <td class="px-4 py-2 text-center"><?= $grade['parcial1'] ?></td>
                                    <td class="px-4 py-2 text-center"><?= $grade['parcial2'] ?></td>
                                    <td class="px-4 py-2 text-center"><?= $grade['final'] ?></td>
                                    <td class="px-4 py-2 text-center">
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
                    <form method="POST" class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Curso</label>
                            <select name="curso_id" required 
                                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Seleccionar Curso</option>
                                <?php foreach ($courses as $course): ?>
                                    <option value="<?= $course['id'] ?>"><?= $course['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Estudiante</label>
                            <select name="estudiante_id" required 
                                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">Seleccionar Estudiante</option>
                                <?php foreach ($students as $student): ?>
                                    <option value="<?= $student['id'] ?>"><?= $student['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nota Parcial 1</label>
                            <input type="number" name="parcial1" required min="0" max="100"
                                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nota Parcial 2</label>
                            <input type="number" name="parcial2" required min="0" max="100"
                                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nota Final (Promedio)</label>
                            <input type="number" name="final" step="0.1" required min="0" max="100"
                                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Promedio de parciales">
                        </div>
                        <div class="flex justify-between">
                            <a href="?action=list_grades" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Guardar Calificación
                            </button>
                        </div>
                    </form>
                </div>

            <?php elseif ($action === 'course_statistics'): ?>
                <!-- Estadísticas del Curso -->
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-4">Estadísticas de Curso</h2>
                    <?php 
                        // Calcular estadísticas para un curso específico
                        $curso_estadisticas = array_filter($grades, function($g) use ($curso_id) { 
                            return $g['curso_id'] == $curso_id; 
                        });

                        $notas_finales = array_column($curso_estadisticas, 'final');
                        $promedio = count($notas_finales) > 0 ? array_sum($notas_finales) / count($notas_finales) : 0;
                        $nota_maxima = count($notas_finales) > 0 ? max($notas_finales) : 0;
                        $nota_minima = count($notas_finales) > 0 ? min($notas_finales) : 0;
                        $aprobados = count(array_filter($curso_estadisticas, function($g) { return $g['final'] >= 70; }));
                        $reprobados = count($curso_estadisticas) - $aprobados;
                    ?>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-100 p-4 rounded">
                            <h3 class="font-bold">Promedio del Curso</h3>
                            <p class="text-2xl"><?= number_format($promedio, 2) ?></p>
                        </div>
                        <div class="bg-green-100 p-4 rounded">
                            <h3 class="font-bold">Tasa de Aprobación</h3>
                            <p class="text-2xl"><?= number_format(($aprobados / count($curso_estadisticas)) * 100, 2) ?>%</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded">
                            <h3 class="font-bold">Nota Máxima</h3>
                            <p class="text-2xl"><?= $nota_maxima ?></p>
                        </div>
                        <div class="bg-red-100 p-4 rounded">
                            <h3 class="font-bold">Nota Mínima</h3>
                            <p class="text-2xl"><?= $nota_minima ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>