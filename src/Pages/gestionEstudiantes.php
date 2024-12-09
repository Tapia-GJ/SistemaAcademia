<?php
include("../../config/db.php");
include("includes/headerAdmin.php");
$redireccionar = $_GET['redireccionar'] ?? 'list';
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
    <?php if ($redireccionar === 'list'): ?>
        <!-- Vista de Lista de Estudiantes -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                <h1 class="text-2xl font-bold">Lista de Estudiantes</h1>
                <a href="?redireccionar=createEstudiante" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded">
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
                        <th class="px-4 py-2 text-left">Telefono</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM estudiantes";
                    $result = mysqli_query($conn, $query);
                    foreach ($result as $fila):
                        ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?php echo $fila['Id_Estudiantes'] ?></td>
                            <td class="px-4 py-2"><?php echo $fila['Nombre_Estudiantes'] ?></td>
                            <td class="px-4 py-2"><?php echo $fila['Apellido_Estudiantes'] ?></td>
                            <td class="px-4 py-2"><?php echo $fila['Correo_Estudiantes'] ?></td>
                            <td class="px-4 py-2"><?php echo $fila['Telefono_Estudiantes'] ?></td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="?redireccionar=editarEstudiante&id=<?= $fila['Id_Estudiantes'] ?>"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                        Editar
                                    </a>
                                    <a href="../../src/Estudiantes/delete_task.php?id=<?= $fila['Id_Estudiantes'] ?>"
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

    <?php elseif ($redireccionar === 'createEstudiante'): ?>
        <!-- Formulario de Creación de Estudiante -->
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Nuevo Estudiante</h2>
            <form action="../../src/Estudiantes/saveEstudiante.php" method="POST" class="space-y-4">
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
                    <label class="block text-gray-700 font-bold mb-2">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" required
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
                    <label class="block text-gray-700 font-bold mb-2">Dirección</label>
                    <input type="text" name="direccion" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Fecha de Registro</label>
                    <input type="date" name="fecha_registro" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Promedio de Calificaciones</label>
                    <input type="text" name="promedio_calificaciones"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-between">
                    <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" name="saveEstudiante" value="saveEstudiante"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </form>
        </div>

    <?php elseif ($redireccionar === 'editarEstudiante'): ?>
        <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM estudiantes WHERE Id_Estudiantes = $id";
        $result = mysqli_query($conn, $query);
        $student = mysqli_fetch_array($result);
        if (!$student): ?>
            <p class="text-red-500">Estudiante no encontrado.</p>
            <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        <?php else: ?>
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Editar Estudiante</h2>
                <form method="POST" action="../../src/Estudiantes/editEstudiante.php" class="space-y-4">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nombre</label>
                        <input type="text" name="Nombre_Estudiantes" required value="<?= $student['Nombre_Estudiantes'] ?>"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Apellido</label>
                        <input type="text" name="apellido" required value="<?= $student['Apellido_Estudiantes'] ?>" 
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" required value="<?= $student['Fecha_Nacimiento'] ?>" 
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" required value="<?= $student['Correo_Estudiantes'] ?>" 
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Teléfono</label>
                        <input type="text" name="telefono" required value="<?= $student['Telefono_Estudiantes'] ?>" 
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Dirección</label>
                        <input type="text" name="direccion" required value="<?= $student['Direccion'] ?>" 
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Fecha de Registro</label>
                        <input type="date" name="fecha_registro" required value="<?= $student['Fecha_Registro'] ?>" 
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Promedio de Calificaciones</label>
                        <input type="text" name="promedio_calificaciones" value="<?= $student['promedio_calificaciones'] ?>" 
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex justify-between">
                        <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" name="editEstudiante" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

    <?php endif; ?>

</div>