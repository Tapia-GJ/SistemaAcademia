<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia Excelencia - Sistema de Control Escolar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
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
                <a href="/pages/gestionEstudiantes.php" class="hover:bg-academia-light px-3 py-2 rounded transition">
                    Gestión de Estudiantes
                </a>
                <a href="/pages/gestionCursos.php" class="hover:bg-academia-light px-3 py-2 rounded transition">
                    Gestión de Cursos
                </a>
                <a href="/pages/registroCalificaciones.php" class="hover:bg-academia-light px-3 py-2 rounded transition">
                    Registro de Calificaciones
                </a>
                <a href="/pages/registroAsistencias.php" class="hover:bg-academia-light px-3 py-2 rounded transition">
                    Registro de Asistencia
                </a>
                <a href="/pages/generacionReportes.php" class="hover:bg-academia-light px-3 py-2 rounded transition">
                    Generación de Reportes
                </a>
                <a href="/pages/gestionProfesores.php" class="hover:bg-academia-light px-3 py-2 rounded transition">
                    Gestión de profesores
                </a>
            </div>
        </div>
    </nav>