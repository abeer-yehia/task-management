<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'To-Do') }}</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteTaskWithConfirmation(event) {
            event.preventDefault(); // Prevent the default form submission or action
        
            // Use SweetAlert2 to show a custom confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3f77ac'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, proceed with the delete action
                    event.target.closest('form').submit(); // Assuming the button is inside a form
                }
            });
        }
    </script>
    <!-- Styles -->
    @livewireStyles
    @powerGridStyles
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            @if (session('status') == true)
            <div class="container">
                <div class="alert alert-success mb-4" role="alert">
                    {{session('message')}}
                </div>
            </div>
            @endif
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    @powerGridScripts
</body>

</html>
