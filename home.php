<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia Excelencia - Sistema de Control Escolar</title>
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

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-academia-blue text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">
                Academia Excelencia
            </div>
            <div class="space-x-4">
                <a href="login.php" class="bg-white text-academia-blue px-4 py-2 rounded hover:bg-gray-100 transition">
                    Iniciar Sesión
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mx-auto mt-10 px-4">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
                <h1 class="text-4xl font-bold text-academia-blue mb-4">
                    Bienvenido a Academia Excelencia
                </h1>
                <p class="text-gray-700 mb-6">
                    Transformamos la educación a través de la tecnología,
                    ofreciendo un sistema integral de gestión escolar
                    que simplifica la administración académica.
                </p>
                <div class="space-x-4">
                    <a href="pages/servicios.php" class="bg-academia-blue text-white px-6 py-3 rounded hover:bg-academia-light transition">
                        Explorar Servicios
                    </a>
                    <a href="pages/contacto.php" class="border border-academia-blue text-academia-blue px-6 py-3 rounded hover:bg-gray-100 transition">
                        Contactanos
                    </a>
                </div>
            </div>
            <div>
                <img
                    src="public/img/Alumnos.svg"
                    alt="Campus Academia Excelencia"
                    class="rounded-lg shadow-xl">
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
          <img src="public/img/escuelaOficial.svg" alt="TOEFL" class="w-32 h-32">
        </div>
        <h3 class="text-2xl font-semibold text-center mb-2">TOEFL</h3>
        <p class="text-gray-600 text-center">Preparación y certificación de inglés</p>
      </div>
      <div class="bg-white p-8 rounded-lg shadow-lg">
        <div class="flex justify-center mb-6">
          <img src="public/img/evaluacionIngles.svg" alt="Aptis" class="w-32 h-32">
        </div>
        <h3 class="text-2xl font-semibold text-center mb-2">Aptis</h3>
        <p class="text-gray-600 text-center">Evaluación de habilidades en inglés</p>
      </div>
      <div class="bg-white p-8 rounded-lg shadow-lg">
        <div class="flex justify-center mb-6">
          <img src="public/img/examenIngles.svg" alt="EOI" class="w-32 h-32">
        </div>
        <h3 class="text-2xl font-semibold text-center mb-2">EOI</h3>
        <p class="text-gray-600 text-center">Escuela Oficial de Idiomas</p>
      </div>
      <div class="bg-white p-8 rounded-lg shadow-lg">
        <div class="flex justify-center mb-6">
          <img src="public/img/inglesLibros.svg" alt="Cambridge" class="w-32 h-32">
        </div>
        <h3 class="text-2xl font-semibold text-center mb-2">Examenes</h3>
        <p class="text-gray-600 text-center">Exámenes de inglés</p>
      </div>
    </div>
  </div>
</section>


    <!-- Características -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-academia-blue mb-12">
                Nuestras Características
            </h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow-md">
                    <svg class="w-16 h-16 mx-auto mb-4 text-academia-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Gestión Integral</h3>
                    <p class="text-gray-600">
                        Sistema completo para administración académica y escolar.
                    </p>
                </div>
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow-md">
                    <svg class="w-16 h-16 mx-auto mb-4 text-academia-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Reportes Precisos</h3>
                    <p class="text-gray-600">
                        Generación de reportes académicos detallados.
                    </p>
                </div>
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow-md">
                    <svg class="w-16 h-16 mx-auto mb-4 text-academia-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Control Total</h3>
                    <p class="text-gray-600">
                        Seguimiento completo de estudiantes y profesores.
                    </p>
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