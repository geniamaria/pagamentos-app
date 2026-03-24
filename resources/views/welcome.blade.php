<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamentos App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-start p-4 md:p-8 lg:p-12">

    <header class="w-full max-w-6xl mb-8">
        <h1 class="text-2xl md:text-4xl font-bold text-center text-gray-800">Pagamentos App</h1>
    </header>

    <main class="w-full max-w-6xl flex flex-col md:flex-row gap-8">
       
        <div class="w-full md:w-2/3 bg-white p-6 rounded-lg shadow-md">
            <pagamento-form></pagamento-form>
        </div>

        <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-md">
            <back-office></back-office>
        </div>
    </main>

    <footer class="w-full max-w-6xl mt-8 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Pagamentos App
    </footer>

</body>
</html>