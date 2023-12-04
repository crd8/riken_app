<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="antialiased">
    {{-- <div class="min-h-screen bg-sky-700/50 dark:bg-sky-900/90"> --}}
      <div class="min-h-screen bg-gray-300 dark:bg-gray-900">
        @include('layouts.navigation')

        <main>
          {{ $slot }}
        </main>
    </div>
    @stack('scripts')
  </body>
</html>
