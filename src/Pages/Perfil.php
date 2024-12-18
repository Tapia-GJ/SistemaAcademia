<?php
include "../../config/db.php";
include "includes/headerAlum.php";
?>
    <!-- --perfil -->
                <?php
                $user = $_SESSION["username"];
                    $query = "SELECT t1.*, t2.* FROM `usuarios` as t1 INNER JOIN estudiantes as t2 ON t1.Estudiantes_Id = t2.Id_Estudiantes WHERE t1.Nombre_Usuarios = '$user';";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($result);
                ?>
                <div class="flex items-center justify-center min-h-screen bg-gray-100">
                <div class="bg-white max-w-2xl shadow overflow-hidden sm:rounded-lg">
                    <!-- <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            xxxxxxxxxxxx
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Excelencia Academica
                        </p>
                    </div> -->
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Nombre
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <?= $row["Nombre_Estudiantes"] ?>
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Apellidos
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <?= $row["Apellido_Estudiantes"] ?>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Fecha de nacimiento
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <?= $row["Fecha_Nacimiento"] ?>
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Correo
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <?= $row["Correo_Estudiantes"] ?>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Telefono
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    +52 <?= $row["Telefono_Estudiantes"] ?>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Direccion
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <?= $row["Direccion"] ?>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">
                                    Fecha de ingreso
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <?= $row["Fecha_Registro"] ?>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

</div>
</body>
</html>