
<?php
include("../../config/db.php");
include("includes/headerAdmin.php");

// Determinar la acción actual
$action = $_GET['action'] ?? 'list';
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
            
            <?php 
            $query = "SELECT * FROM profesores";
            $result = mysqli_query($conn, $query);
            foreach ($result as $professor): ?>
            <div class="max-w-xs mx-auto">
                <div class="bg-white shadow-xl rounded-lg py-3">
                    <div class="photo-wrapper p-2">
                        <img class="w-32 h-32 rounded-full mx-auto" src="/public/img/user.png" alt="<?= $professor['Nombre_Profesores'] ?>">
                    </div>
                    <div class="p-2">
                        <h3 class="text-center text-xl text-gray-900 font-medium leading-8"><?= $professor['Nombre_Profesores'] ?> <?= $professor['Apellido_Profesores'] ?></h3>
                        <div class="text-center text-gray-400 text-xs font-semibold">
                            <p><?= $professor['Especialidad'] ?></p>
                        </div>
                        <table class="text-xs my-3 w-full">
                            <tbody>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Correo Electrónico</td>
                                    <td class="px-2 py-2"><?= $professor['Correo_Profesores'] ?></td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Teléfono</td>
                                    <td class="px-2 py-2"><?= $professor['Telefono_Profesores'] ?></td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Especialidad</td>
                                    <td class="px-2 py-2"><?= $professor['Especialidad'] ?></td>
                                </tr>
                                <tr>
                                    <td class="px-2 py-2 text-gray-500 font-semibold">Fecha Contratación</td>
                                    <td class="px-2 py-2"><?= $professor['Fecha_Contratacion'] ?></td>
                                </tr>
                                <tr>
                                <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href ="?action=editCurso&id=<?= $professor['Id_Profesores'] ?>"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                        Editar
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>src/Profesores/deleteProfe.php?id=<?= $professor['Id_Profesores'] ?>"
                                        onclick="return confirm('¿Estás seguro?')"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Eliminar
                                    </a>
                                </div>
                            </td>
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
            <form method="POST" action="<?php echo BASE_URL; ?>src/Profesores/saveProfe.php" class="space-y-4">
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
                    <button type="submit" name="saveProfe" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    <?php elseif ($action === 'editCurso'): ?>
        <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM profesores WHERE Id_Profesores = $id";
        $result = mysqli_query($conn, $query);
        $profe = mysqli_fetch_array($result);
        if (!$profe): ?>
            <p class="text-red-500">Profesor no encontrado.</p>
            <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        <?php else: ?>
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Nuevo Profesor</h2>
            <form method="POST" action="<?php echo BASE_URL; ?>src/Profesores/editProfe.php" class="space-y-4">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nombre</label>
                    <input type="text" name="nombre" required value="<?= $profe['Nombre_Profesores'] ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Apellido</label>
                    <input type="text" name="apellido" required value="<?= $profe['Apellido_Profesores'] ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" required value="<?= $profe['Correo_Profesores'] ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Teléfono</label>
                    <input type="text" name="telefono" required value="<?= $profe['Telefono_Profesores'] ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Especialidad</label>
                    <input type="text" name="especialidad" required value="<?= $profe['Especialidad'] ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Fecha de Contratación</label>
                    <input type="date" name="fecha_contratacion" required value="<?= $profe['Fecha_Contratacion'] ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-between">
                    <a href="?action=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" name="editProfe" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>
