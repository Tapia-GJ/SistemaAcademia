
<?php
// Configuración de base de datos y lógica (simulada para el ejemplo)
$students = [
    ['id' => 1, 'nombre' => 'Juan', 'apellido' => 'Pérez', 'email' => 'juan@example.com', 'carrera' => 'Sistemas', 'fecha_nacimiento' => '2000-01-15'],
    ['id' => 2, 'nombre' => 'María', 'apellido' => 'García', 'email' => 'maria@example.com', 'carrera' => 'Derecho', 'fecha_nacimiento' => '1999-05-20']
];

// Determinar la acción actual
$action = $_GET['action'] ?? 'list';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Estudiantes - Academia Excelencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
        <?php if ($action === 'list'): ?>
            <!-- Vista de Lista de Estudiantes -->
            <div class="bg-white shadow-md rounded-lg">
                <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                    <h1 class="text-2xl font-bold">Lista de Estudiantes</h1>
                    <a href="?action=create" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded">
                        + Agregar Estudiante
                    </a>
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
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nombre</label>
                        <input type="text" name="nombre" required 
                               value="<?= $students[$id-1]['nombre'] ?>"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Apellido</label>
                        <input type="text" name="apellido" required 
                               value="<?= $students[$id-1]['apellido'] ?>"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" required 
                               value="<?= $students[$id-1]['email'] ?>"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" required 
                               value="<?= $students[$id-1]['fecha_nacimiento'] ?>"
                               class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Carrera</label>
                        <select name="carrera" required 
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Sistemas" <?= $students[$id-1]['carrera'] == 'Sistemas' ? 'selected' : '' ?>>
                                Ingeniería de Sistemas
                            </option>
                            <option value="Derecho" <?= $students[$id-1]['carrera'] == 'Derecho' ? 'selected' : '' ?>>
                                Derecho
                            </option>
                            <option value="Medicina" <?= $students[$id-1]['carrera'] == 'Medicina' ? 'selected' : '' ?>>
                                Medicina
                            </option>
                            <option value="Administración" <?= $students[$id-1]['carrera'] == 'Administración' ? 'selected' : '' ?>>
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
        <?php endif; ?>
    </div>
</body>
</html>