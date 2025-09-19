@props(['breadcrumb' => []])
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/e1238f483a.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="antialiased">
<div x-data="{ showSidebar: false }" class="relative flex min-h-screen w-full flex-col md:flex-row">

    <!-- Sidebar Include -->
    @include('layouts.includes.admin.sidebar')

    <!-- Main Content Area -->
    <main id="main-content" class="flex-1 min-h-screen overflow-y-auto bg-surface dark:bg-surface-dark md:ml-0">

        <!-- Header with breadcrumb -->
        <header class="bg-surface border-b border-outline dark:bg-surface-dark dark:border-outline-dark">
            <div class="p-4">
                @include('layouts.includes.admin.breadcrum')
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-4">
            {{ $slot }}
        </div>

    </main>

    <!-- Mobile Toggle Button -->
    <button
        type="button"
        x-cloak
        class="fixed right-4 top-1 z-30 rounded-md bg-primary p-3 shadow-lg md:hidden text-on-primary dark:bg-primary-dark dark:text-on-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-primary-dark"
        x-on:click="showSidebar = !showSidebar"
        aria-label="Toggle sidebar"
        x-bind:aria-expanded="showSidebar">

        <!-- Close Icon -->
        <i x-show="showSidebar"
           class="fas fa-times text-md"
           aria-hidden="true"></i>

        <!-- Menu Icon -->
        <i x-show="!showSidebar"
           class="fas fa-bars text-md"
           aria-hidden="true"></i>

        <span class="sr-only">Toggle sidebar</span>
    </button>

</div>

@stack('modals')
@livewireScripts
</body>
</html>
