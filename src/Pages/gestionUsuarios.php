<?php
include("../../config/db.php");
include("includes/headerAdmin.php");

// Determinar la acción actual
$action = $_GET['action'] ?? 'list';
?>
<div class="container mx-auto px-6">
    <?php if (isset($_SESSION['mensaje'])) : ?>
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
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>
</div>
<div class="container mx-auto p-6">

    <?php if ($action === 'list'): ?>
        <!-- Encabezado -->
        <div>
            <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                <h1 class="text-2xl font-bold">Lista de Usuarios</h1>
                <a href="?action=create" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded">
                    + Agregar Usuario
                </a>
            </div>
        </div>
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Usuario</th>
                    <th class="px-4 py-2 text-left">Rol</th>
                    <th class="px-4 py-2 text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT t1.Id_Usuarios, t1.Nombre_Usuarios, t2.Nombre_Roles 
                          FROM usuarios t1 
                          INNER JOIN roles t2 ON t1.Roles_Id_Roles = t2.Id_Roles";
                $result = mysqli_query($conn, $query);
                foreach ($result as $fila):
                ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2"><?= $fila['Id_Usuarios'] ?></td>
                        <td class="px-4 py-2"><?= $fila['Nombre_Usuarios'] ?></td>
                        <td class="px-4 py-2"><?= $fila['Nombre_Roles'] ?></td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="?action=edit&id=<?= $fila['Id_Usuarios'] ?>"
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    Editar
                                </a>
                                <a href="../../src/Usuarios/deleteUsuario.php?id=<?= $fila['Id_Usuarios'] ?>"
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
    <?php elseif ($action === 'create' || $action === 'edit'): ?>
        <?php
        $roles_query = "SELECT * FROM roles";
        $roles_result = mysqli_query($conn, $roles_query);
        //si action es editar
        if (isset($_GET['id'])) {
            $queryUser = "Select * from usuarios where Id_Usuarios = {$_GET['id']}";
            $resultUser = mysqli_query($conn, $queryUser);
            $user = mysqli_fetch_array($resultUser);
        }else{
            $user = ['Id_Usuarios' => '', 'Nombre_Usuarios' => '', 'Contrasena_Usuarios' => '', 'Roles_Id_Roles' => ''];
        }
        ?>
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">
                <?= $action === 'create' ? 'Agregar Usuario' : 'Editar Usuario' ?>
            </h2>
            <form method="POST" action="<?php echo BASE_URL; ?>src/Cursos/gestionUsuarios.php" class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nombre de Usuario</label>
                    <input type="hidden" name="id" value="<?= $action === 'edit' ? $user['Id_Usuarios'] : '' ?>">
                    <input type="text" name="user" required
                        value="<?= $action === 'edit' ? $user['Nombre_Usuarios'] : '' ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Contraseña</label>
                    <input type="password" name="password" required value="<?= $user['Contrasena_Usuarios'] ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Rol</label>
                    <select name="rol" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php while ($rol = mysqli_fetch_array($roles_result)) : ?>
                            <option value="<?php echo $rol['Id_Roles'] ?>" <?= ($rol['Id_Roles'] == $user['Roles_Id_Roles']) ? 'selected' : ''  ?>>
                                <?= $rol['Nombre_Roles'] ?>
                            </option>
                        <?php endwhile;
                        ?>
                    </select>
                </div>
                <div class="flex justify-between">
                    <a href="?action=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" name="saveUsuario" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    <?php elseif ($action === 'edit'): ?>

    <?php endif; ?>
</div>
</body>

</html>