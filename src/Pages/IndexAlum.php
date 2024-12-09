<?php
include "../../config/db.php";
include "includes/headerAlum.php";
?>
    <!-- Hero Section -->
    <section class="container mx-auto mt-10 px-4">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl font-bold text-academia-blue mb-4">
                    Bienvenido #####
                </h1>
                <p class="text-gray-700 mb-6">
                ¡Bienvenidos a su plataforma de calificaciones escolares! Aquí podrán consultar su progreso académico, mantenerse informados y alcanzar sus metas con éxito. ¡El futuro está en sus manos!
                </p>
                <div class="space-x-4">
                    <a href="<?php echo BASE_URL; ?>src/Pages/Perfil.php" class="bg-academia-blue text-white px-6 py-3 rounded hover:bg-academia-light transition">
                        Ver Perfil
                    </a>
                    <a href="<?php echo BASE_URL; ?>src/Pages/BoletaCali.php" class="border border-academia-blue text-academia-blue px-6 py-3 rounded hover:bg-gray-100 transition">
                        Calificaciones
                    </a>
                </div>
            </div>
            <div>
            
            <img src="/public/img/Alumnos.svg" alt="Campus Academia Excelencia" class="rounded-lg shadow-xl">

            </div>
        </div>
    </section>

    <!-- Certificaciones que Abren Puertas -->
    <section class="bg-gray-100 py-16">
  <div class="container mx-auto px-4">
    <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Certificaciones que Abren Puertas</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">
      <div class="bg-white p-8 rounded-lg shadow-lg">
        <div class="flex justify-center mb-6">
          <img src="/public/img/escuelaOficial.svg" alt="TOEFL" class="w-32 h-32">
        </div>
        <h3 class="text-2xl font-semibold text-center mb-2">TOEFL</h3>
        <p class="text-gray-600 text-center">Preparación y certificación de inglés</p>
      </div>
      <div class="bg-white p-8 rounded-lg shadow-lg">
        <div class="flex justify-center mb-6">
          <img src="/public/img/escuelaOficial.svg"alt="Aptis" class="w-32 h-32">
        </div>
        <h3 class="text-2xl font-semibold text-center mb-2">Aptis</h3>
        <p class="text-gray-600 text-center">Evaluación de habilidades en inglés</p>
      </div>
      <div class="bg-white p-8 rounded-lg shadow-lg">
        <div class="flex justify-center mb-6">
          <img src="/public/img/evaluacionIngles.svg" alt="EOI" class="w-32 h-32">
        </div>
        <h3 class="text-2xl font-semibold text-center mb-2">EOI</h3>
        <p class="text-gray-600 text-center">Escuela Oficial de Idiomas</p>
      </div>
      <div class="bg-white p-8 rounded-lg shadow-lg">
        <div class="flex justify-center mb-6">
          <img src="/public/img/examenIngles.svg" alt="Cambridge" class="w-32 h-32">
        </div>
        <h3 class="text-2xl font-semibold text-center mb-2">Examenes</h3>
        <p class="text-gray-600 text-center">Exámenes de inglés</p>
      </div>
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