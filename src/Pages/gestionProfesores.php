
<?php
// Configuración de base de datos y lógica (simulada para el ejemplo)
$professors = [
    ['id' => 1, 'nombre' => 'Carlos', 'apellido' => 'Méndez', 'email' => 'carlos@example.com', 'telefono' => '+12 34 5678 9012', 'especialidad' => 'Matemáticas', 'fecha_contratacion' => '2015-08-12'],
    ['id' => 2, 'nombre' => 'Ana', 'apellido' => 'Rodríguez', 'email' => 'ana@example.com', 'telefono' => '+12 34 5678 9013', 'especialidad' => 'Historia', 'fecha_contratacion' => '2018-09-03'],
    ['id' => 3, 'nombre' => 'Luis', 'apellido' => 'Gómez', 'email' => 'luis@example.com', 'telefono' => '+12 34 5678 9014', 'especialidad' => 'Química', 'fecha_contratacion' => '2020-01-15']
];

// Determinar la acción actual
$action = $_GET['action'] ?? 'list';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Profesores - Academia Excelencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'academia-blue': '#1E40AF',
                        'academia-light': '#3B82F6',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen">


<nav class="bg-academia-blue text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">
                Academia Excelencia
            </div>
            <div class="space-x-4">
                <a href="/pages/IndexAdmi.php" class="hover:bg-academia-light px-3 py-2 rounded transition">
                    Inicio 
                </a>
            </div>
        </div>
    </nav>

    <?php if ($action === 'list'): ?>
        <!-- Encabezado -->
        <div>
            <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                <h1 class="text-2xl font-bold">Lista de Profesores</h1>
                <a href="?action=create" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded">
                    + Agregar Profesor
                </a>
            </div>
        </div>

        <!-- Contenedor de Tarjetas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6">
            <?php foreach ($professors as $professor): ?>
            <div class="max-w-xs mx-auto">
                <div class="bg-white shadow-xl rounded-lg py-3">
                    <div class="photo-wrapper p-2">
                        <img class="w-32 h-32 rounded-full mx-auto" src="/public/img/user.png" alt="<?= $professor['nombre'] ?>">
                    </div>
                    <div class="p-2">
                        <h3 class="text-center text-xl text-gray-900 font-medium leading-8"><?= $professor['nombre'] ?> <?= $professor['apellido'] ?></h3>
                        <div class="text-center text-gray-400 text-xs font-semibold">
                            <p><?= $professor['especialidad'] ?></p>
                        </div>
                        <table class="text-xs my-3 w-full">
                            <tbody>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Correo Electrónico</td>
                                    <td class="px-2 py-2"><?= $professor['email'] ?></td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Teléfono</td>
                                    <td class="px-2 py-2"><?= $professor['telefono'] ?></td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Especialidad</td>
                                    <td class="px-2 py-2"><?= $professor['especialidad'] ?></td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Fecha Contratación</td>
                                    <td class="px-2 py-2"><?= $professor['fecha_contratacion'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    <?php elseif ($action === 'create'): ?>
        <!-- Formulario de Creación de Profesor -->
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Nuevo Profesor</h2>
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
                    <label class="block text-gray-700 font-bold mb-2">Teléfono</label>
                    <input type="text" name="telefono" required 
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Especialidad</label>
                    <input type="text" name="especialidad" required 
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Fecha de Contratación</label>
                    <input type="date" name="fecha_contratacion" required 
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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

    <?php endif; ?>

</body>
</html>
