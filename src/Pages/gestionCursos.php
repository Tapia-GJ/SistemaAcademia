<?php
// Configuración de base de datos y lógica (simulada para el ejemplo)
$courses = [
    ['id' => 1, 'nombre' => 'Introducción a la Programación', 'codigo' => 'SIS101', 'creditos' => 4, 'profesor' => 'Juan Pérez', 'carrera' => 'Sistemas'],
    ['id' => 2, 'nombre' => 'Derecho Constitucional', 'codigo' => 'DER201', 'creditos' => 3, 'profesor' => 'María García', 'carrera' => 'Derecho']
];

// Determinar la acción actual
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
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
        <?php if ($action === 'list'): ?>
            <!-- Vista de Lista de Cursos -->
            <div class="bg-white shadow-md rounded-lg">
                <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                    <h1 class="text-2xl font-bold">Lista de Cursos</h1>
                    <a href="?action=create" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">
                        + Agregar Curso
                    </a>
                </div>

                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Código</th>
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Créditos</th>
                            <th class="px-4 py-2 text-left">Profesor</th>
                            <th class="px-4 py-2 text-left">Carrera</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2"><?= $course['id'] ?></td>
                                <td class="px-4 py-2"><?= $course['codigo'] ?></td>
                                <td class="px-4 py-2"><?= $course['nombre'] ?></td>
                                <td class="px-4 py-2"><?= $course['creditos'] ?></td>
                                <td class="px-4 py-2"><?= $course['profesor'] ?></td>
                                <td class="px-4 py-2"><?= $course['carrera'] ?></td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="?action=edit&id=<?= $course['id'] ?>" 
                                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            Editar
                                        </a>
                                        <a href="?action=delete&id=<?= $course['id'] ?>" 
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
            <!-- Formulario de Creación de Curso -->
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center text-green-600">Nuevo Curso</h2>
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Código de Curso</label>
                        <input type="text" name="codigo" required 
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="Ej. SIS101">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nombre del Curso</label>
                        <input type="text" name="nombre" required 
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="Nombre completo del curso">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Créditos</label>
                        <input type="number" name="creditos" required min="1" max="6"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Profesor</label>
                        <input type="text" name="profesor" required 
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                               placeholder="Nombre del profesor">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Carrera</label>
                        <select name="carrera" required 
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
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
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>

        <?php elseif ($action === 'edit'): ?>
            <!-- Formulario de Edición de Curso -->
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center text-green-600">Editar Curso</h2>
                <form method="POST" class="space-y-4">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Código de Curso</label>
                        <input type="text" name="codigo" required 
                               value="<?= $courses[$id-1]['codigo'] ?>"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nombre del Curso</label>
                        <input type="text" name="nombre" required 
                               value="<?= $courses[$id-1]['nombre'] ?>"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Créditos</label>
                        <input type="number" name="creditos" required min="1" max="6"
                               value="<?= $courses[$id-1]['creditos'] ?>"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Profesor</label>
                        <input type="text" name="profesor" required 
                               value="<?= $courses[$id-1]['profesor'] ?>"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Carrera</label>
                        <select name="carrera" required 
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="Sistemas" <?= $courses[$id-1]['carrera'] == 'Sistemas' ? 'selected' : '' ?>>
                                Ingeniería de Sistemas
                            </option>
                            <option value="Derecho" <?= $courses[$id-1]['carrera'] == 'Derecho' ? 'selected' : '' ?>>
                                Derecho
                            </option>
                            <option value="Medicina" <?= $courses[$id-1]['carrera'] == 'Medicina' ? 'selected' : '' ?>>
                                Medicina
                            </option>
                            <option value="Administración" <?= $courses[$id-1]['carrera'] == 'Administración' ? 'selected' : '' ?>>
                                Administración
                            </option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <a href="?action=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>