<?php
include "includes/headerProfe.php";

// if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 2) {
//     header('Location: ../../index.php');
//     exit;
// }
?>

    <!-- Hero Section -->
    <section class="container mx-auto mt-10 px-4">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl font-bold text-academia-blue mb-4">
                    Bienvenido Profesor
                </h1>
                <p class="text-gray-700 mb-6">
                    ¡Bienvenidos a su plataforma de calificaciones escolares! Aquí podrán consultar su progreso académico, mantenerse informados y alcanzar sus metas con éxito. ¡El futuro está en sus manos!
                </p>
                <div class="space-x-4">
                    <a href="<?php echo BASE_URL; ?>src/Pages/registroAsistenciasProfe.php" class="bg-academia-blue text-white px-6 py-3 rounded hover:bg-academia-light transition">
                        Asistencia
                    </a>
                    <a href="<?php echo BASE_URL; ?>src/Pages/registroCalificacionesProfe.php" class="border border-academia-blue text-academia-blue px-6 py-3 rounded hover:bg-gray-100 transition">
                        Calificaciones
                    </a>
                </div>
            </div>
            <div>

                <img src="/public/img/profesores.png" style="width: 50%; height: auto; margin-left: 170px;">

            </div>
        </div>
    </section>

    <!-- boton -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4 flex flex-col items-center">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Gestionar</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                <a href="<?php echo BASE_URL; ?>src/Pages/gestionCursoPrfe.php" class="bg-white p-8 rounded-lg shadow-lg block hover:bg-gray-200 transition duration-300">
                    <div class="flex justify-center mb-6">
                        <img src="/public/img/curso.png" alt="curso" class="w-32 h-32">
                    </div>
                    <h3 class="text-2xl font-semibold text-center mb-2">Gestión de cursos</h3>
                    <p class="text-gray-600 text-center">Lista, creación, asignación de profesores y horarios.</p>
                </a>
                <a href="<?php echo BASE_URL; ?>src/Pages/registroCalificacionesProfe.php" class="bg-white p-8 rounded-lg shadow-lg block hover:bg-gray-200 transition duration-300">
                    <div class="flex justify-center mb-6">
                        <img src="/public/img/10.png" alt="EOI" class="w-32 h-32">
                    </div>
                    <h3 class="text-2xl font-semibold text-center mb-2">Registro de Calificaciones</h3>
                    <p class="text-gray-600 text-center">Ingreso, consulta y actualización.</p>
                </a>
                <a href="<?php echo BASE_URL; ?>src/Pages/registroAsistenciasProfe.php" class="bg-white p-8 rounded-lg shadow-lg block hover:bg-gray-200 transition duration-300">
                    <div class="flex justify-center mb-6">
                        <img src="/public/img/asistencia.png" alt="Aptis" class="w-32 h-32">
                    </div>
                    <h3 class="text-2xl font-semibold text-center mb-2">Registro de asistencia</h3>
                    <p class="text-gray-600 text-center">Registro, consulta y actualización</p>
                </a>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="bg-academia-blue text-white py-12">
        <div class="container mx-auto px-4 grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">Academia Excelencia</h3>
                <p class="text-gray-300">
                    Formando profesionales del futuro con tecnología y excelencia académica.
                </p>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Contacto</h4>
                <p>Teléfono: (55) 1234-5678</p>
                <p>Email: info@academiaexcelencia.edu.mx</p>
                <p>Dirección: Av. Educación 123, CDMX</p>
            </div>
        </div>
        <div class="text-center mt-8 border-t border-gray-700 pt-4">
            © 2024 Academia Excelencia. Todos los derechos reservados.
        </div>
    </footer>
</body>

</html>