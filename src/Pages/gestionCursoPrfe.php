<?php
// Configuración de base de datos y lógica (simulada para el ejemplo)
$courses = [
    ['id' => 1, 'nombre' => 'Introducción a la Programación', 'codigo' => 'SIS101', 'creditos' => 4, 'carrera' => 'Sistemas'],
    ['id' => 2, 'nombre' => 'Derecho Constitucional', 'codigo' => 'DER201', 'creditos' => 3, 'carrera' => 'Derecho']
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Cursos - Academia Excelencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
        <!-- Vista de Lista de Cursos -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="bg-blue-500 text-white p-4">
                <h1 class="text-2xl font-bold">Lista de Cursos</h1>
            </div>
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Código</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Créditos</th>
                        <th class="px-4 py-2 text-left">Carrera</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?= $course['id'] ?></td>
                            <td class="px-4 py-2"><?= $course['codigo'] ?></td>
                            <td class="px-4 py-2"><?= $course['nombre'] ?></td>
                            <td class="px-4 py-2"><?= $course['creditos'] ?></td>
                            <td class="px-4 py-2"><?= $course['carrera'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
