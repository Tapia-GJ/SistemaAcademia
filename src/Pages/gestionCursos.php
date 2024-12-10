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
        <!-- Vista de Lista de Cursos -->
        <div class="bg-white shadow-md rounded-lg">
            <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                <h1 class="text-2xl font-bold">Lista de Cursos</h1>
                <div>
                    <a href="?redireccionar=createCurso" class="bg-blue-500 hover:bg-blue-600 px-2 py-2 rounded">
                        + Agregar Curso
                    </a>
                </div>

            </div>

            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Descripción</th>
                        <th class="px-4 py-2 text-left">Créditos</th>
                        <!-- <th class="px-4 py-2 text-left">Profesor</th> -->
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $query = "SELECT *, t2.*, t3.* FROM `cursos` as t1 LEFT JOIN profesores_cursos as t2 on t1.Id_Cursos=t2.Cursos_Id_Cursos left JOIN profesores as t3 on  t2.Profesores_Id_Profesores = t3.Id_Profesores;";
                    $query = "SELECT * FROM `cursos`;";
                    $result = mysqli_query($conn, $query);
                    foreach ($result as $course):
                        ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?= $course['Id_Cursos'] ?></td>
                            <td class="px-4 py-2"><?= $course['Nombre_Cursos'] ?></td>
                            <td class="px-4 py-2"><?= $course['Descripcion'] ?></td>
                            <td class="px-4 py-2"><?= $course['Creditos'] ?></td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="?redireccionar=editCursoProfe&id=<?= $course['Id_Cursos'] ?>"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                        Editar
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>src/Cursos/deleteCurso.php?id=<?= $course['Id_Cursos'] ?>"
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
        <div class="bg-white shadow-md rounded-lg mt-6">
            <div class="flex justify-between items-center bg-blue-500 text-white p-4">
                <h1 class="text-2xl font-bold">Lista de Cursos impartidos por profesores</h1>
                <div>
                    <a href="?redireccionar=createCursoProfe" class="bg-blue-500 hover:bg-blue-600 px-2 py-2 rounded">
                        + Agregar Profesor a un Curso
                    </a>
                </div>

            </div>

            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">Curso</th>
                        <th class="px-4 py-2 text-left">Profesor</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT t1.*, t2.*, t3.* FROM `cursos` as t1 inner join profesores_cursos as t2 on t1.Id_Cursos=t2.Cursos_Id_Cursos inner join profesores as t3 on  t2.Profesores_Id_Profesores = t3.Id_Profesores;";
                    //$query = "SELECT * FROM `cursos`;";
                    $result = mysqli_query($conn, $query);
                    foreach ($result as $course):
                        ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2"><?= $course['Nombre_Cursos'] ?></td>
                            <td class="px-4 py-2"><?= $course['Nombre_Profesores'] . " " . $course['Apellido_Profesores'] ?></td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="?redireccionar=editCursoProfe&id_Curso=<?= $course['Id_Cursos'] ?>&id_Profe=<?= $course['Id_Profesores'] ?>"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                        Editar
                                    </a>
                                    <!-- <a href="<?php echo BASE_URL; ?>src/Cursos/deleteCurso.php?id=<?= $course['Id_Cursos'] ?>"
                                        onclick="return confirm('¿Estás seguro?')"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Eliminar
                                    </a> -->
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php elseif ($redireccionar === 'createCurso'): ?>
        <!-- Formulario de Creación de Curso -->
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Nuevo Curso</h2>
            <form method="POST" action="<?php echo BASE_URL; ?>src/Cursos/saveCurso.php" class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nombre del curso</label>
                    <input type="text" name="nombre" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Escriba el nombre del curso...">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Descripción</label>
                    <input type="text" name="descripcion" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Descripción del curso...">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Créditos</label>
                    <input type="number" name="creditos" required min="1" max="6"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <!-- <div>
                    <label class="block text-gray-700 font-bold mb-2">Carrera</label>
                    <select name="carrera" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Seleccionar Carrera</option>
                        <option value="Sistemas">Ingeniería de Sistemas</option>
                        <option value="Derecho">Derecho</option>
                        <option value="Medicina">Medicina</option>
                        <option value="Administración">Administración</option>
                    </select>
                </div> -->
                <div class="flex justify-between">
                    <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" name="saveCurso"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </form>
        </div>

    <?php elseif ($redireccionar === 'editCurso'): ?>
        <!-- Formulario de Edición de Curso -->
        <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM cursos WHERE Id_Cursos = $id";
        $result = mysqli_query($conn, $query);
        $curso = mysqli_fetch_array($result);
        if (!$curso): ?>
            <p class="text-red-500">Estudiante no encontrado.</p>
            <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        <?php else: ?>
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center text-green-600">Editar Curso</h2>
                <form method="POST" action="<?php echo BASE_URL; ?>src/Cursos/editCurso.php" class="space-y-4">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nombre del curso</label>
                        <input type="text" name="nombre" required value="<?= $curso['Nombre_Cursos'] ?>"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Descripción</label>
                        <input type="text" name="descripcion" required value="<?= $curso['Descripcion'] ?>"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Créditos</label>
                        <input type="number" name="creditos" required value="<?= $curso['Creditos'] ?>" min="1" max="6"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="flex justify-between">
                        <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" name="editCurso"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    <?php elseif ($redireccionar === 'createCursoProfe'): ?>
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Agregar Profesor a un curso</h2>
            <form method="POST" action="<?php echo BASE_URL; ?>src/Cursos/saveCurso.php" class="space-y-4">
                <div>

                    <label class="block text-gray-700 font-bold mb-2">Curso</label>
                    <select name="Curso" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Seleccionar Cursos</option>
                        <?php
                        $query = "SELECT * FROM `cursos`";
                        $result = mysqli_query($conn, $query);
                        foreach ($result as $course):
                        ?>
                        <option value="<?=$course['Id_Cursos']?>"><?=$course['Nombre_Cursos']?></option>
                        <?php endforeach; ?>
                    </select>
                    <label class="block text-gray-700 font-bold mb-2">Profesor</label>
                    <select name="profesor" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Seleccionar Profesor</option>
                        <?php
                        $query = "SELECT * FROM `profesores`";
                        $result = mysqli_query($conn, $query);
                        foreach ($result as $course):
                        ?>
                        <option value="<?=$course['Id_Profesores']?>"><?=$course['Nombre_Profesores']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex justify-between">
                    <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" name="saveCursoProfe"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    <?php elseif ($redireccionar === 'editCursoProfe'): ?>
        <?php
        $id_Profe = $_GET['id_Profe'];
        $id_Curso = $_GET['id_Curso'];
        $query = "SELECT t1.*, t2.*, t3.* FROM `cursos` as t1 inner join profesores_cursos as t2 on t1.Id_Cursos=t2.Cursos_Id_Cursos inner join profesores as t3 on  t2.Profesores_Id_Profesores = t3.Id_Profesores WHERE Profesores_Id_Profesores = $id_Profe and Cursos_Id_Cursos = $id_Curso";
        $result = mysqli_query($conn, $query);
        $curso = mysqli_fetch_array($result);
        if (!$curso): ?>
            <p class="text-red-500">Carga no encontrada.</p>
            <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        <?php else: ?>
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Editar Profesor de un curso</h2>
            <form method="POST" action="<?php echo BASE_URL; ?>src/Cursos/editCurso.php" class="space-y-4">
            <input type="hidden" name="profeAnterior" value="<?= $curso['Profesores_Id_Profesores'] ?>" >
            <input type="hidden" name="cursoAnterior" value="<?= $curso['Cursos_Id_Cursos'] ?>" >
                <div>

                    <label class="block text-gray-700 font-bold mb-2">Curso</label>
                    

                    <select name="Curso" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="<?= $curso['Cursos_Id_Cursos'] ?>"><?= $curso['Nombre_Cursos'] ?></option>
                        <?php
                        $query = "SELECT * FROM `cursos`";
                        $result = mysqli_query($conn, $query);
                        foreach ($result as $course):
                        ?>
                        <option value="<?=$course['Id_Cursos']?>"><?=$course['Nombre_Cursos']?></option>
                        <?php endforeach; ?>
                    </select>
                    <label class="block text-gray-700 font-bold mb-2">Profesor</label>
                    <select name="profesor" required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="<?= $curso['Profesores_Id_Profesores'] ?>"><?= $curso['Nombre_Profesores'] . " " . $curso['Apellido_Profesores'] ?></option>
                        <?php
                        $query = "SELECT * FROM `profesores`";
                        $result = mysqli_query($conn, $query);
                        foreach ($result as $course):
                        ?>
                        <option value="<?=$course['Id_Profesores']?>"><?=$course['Nombre_Profesores']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex justify-between">
                    <a href="?redireccionar=list" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" name="editCursoProfe"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
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