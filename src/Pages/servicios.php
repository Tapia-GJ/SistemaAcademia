<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar Servicios - Academia Excelencia</title>
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
                <h2 class="text-2xl font-bold mb-4">Nuestros Servicios</h2>
                <p class="mb-4">
                    Explore nuestros diversos servicios diseñados para brindar una educación integral y de calidad a nuestros estudiantes.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <i class="fas fa-chalkboard-teacher mr-4 text-purple-500"></i>
                        <div>
                            <h3 class="font-bold">Enseñanza Personalizada</h3>
                            <p>
                                Nuestros maestros altamente capacitados se enfocan en el desarrollo individual de cada estudiante.
                            </p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-graduation-cap mr-4 text-purple-500"></i>
                        <div>
                            <h3 class="font-bold">Programa Académico Sólido</h3>
                            <p>
                                Ofrecemos un programa académico de vanguardia que prepara a nuestros estudiantes para el éxito.
                            </p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-laptop-code mr-4 text-purple-500"></i>
                        <div>
                            <h3 class="font-bold">Tecnología Integrada</h3>
                            <p>
                                Utilizamos tecnología de punta para mejorar la experiencia de aprendizaje de nuestros estudiantes.
                            </p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-child mr-4 text-purple-500"></i>
                        <div>
                            <h3 class="font-bold">Desarrollo Integral</h3>
                            <p>
                                Nos enfocamos en el desarrollo académico, social y emocional de nuestros estudiantes.
                            </p>
                        </div>
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
            &copy; 2023 Academia Excelencia. Todos los derechos reservados.
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>