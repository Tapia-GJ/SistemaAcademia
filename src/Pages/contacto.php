<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Academia Excelencia</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="flex flex-col min-h-screen">
    <header class="bg-purple-500 text-white py-4">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold">Academia Excelencia</h1>
        </div>
    </header>

    <main class="container mx-auto py-8 px-4 flex-grow">
        <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-2xl font-bold mb-4">Contacto</h2>
                <p class="mb-4">
                    Estamos aquí para ayudarte. Si tienes alguna pregunta o comentario, no dudes en comunicarte con nosotros. Nuestro equipo de soporte está disponible de lunes a viernes de 8 am a 6 pm.
                </p>
                <ul class="space-y-2">
                    <li>
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        Av. Siempre Viva 123, Ciudad Esperanza
                    </li>
                    <li>
                        <i class="fas fa-phone-alt mr-2"></i>
                        +1 (555) 555-5555
                    </li>
                    <li>
                        <i class="fas fa-envelope mr-2"></i>
                        info@academiaexcelencia.com
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="text-2xl font-bold mb-4">Nuestras Instalaciones</h2>
                <div class="grid grid-cols-2 gap-4">
                    <img src="../public/img/aula.jpg" alt="Aula" class="rounded-md shadow-md">
                    <img src="../public/img/laboratorio.jpg" alt="Laboratorio" class="rounded-md shadow-md">
                    <img src="../public/img/biblioteca.jpg" alt="Biblioteca" class="rounded-md shadow-md">
                    <img src="../public/img/patio.jpg" alt="Patio" class="rounded-md shadow-md">
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-purple-500 text-white py-4 mt-auto">
        <div class="container mx-auto px-4 text-center">
            &copy; 2024 Academia Excelencia. Todos los derechos reservados.
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>