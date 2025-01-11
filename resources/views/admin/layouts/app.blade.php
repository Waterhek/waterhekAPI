<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <!-- Add your CSS files here -->
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body class="font-sans">
    <div id="app">
        <!-- Header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Admin Panel</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Sidebar -->
        <div class="container flex">
            <nav id="sidebar" class="w-1/4 bg-white p-4 shadow">
                <ul>
                    <li class="mb-2">
                        <a class="text-gray-700 hover:text-gray-900" href="">
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="text-gray-700 hover:text-gray-900" href="">
                            Blogs
                        </a>
                    </li>
                    <!-- Add more sidebar items here -->
                </ul>
            </nav>

            <main class="w-3/4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>