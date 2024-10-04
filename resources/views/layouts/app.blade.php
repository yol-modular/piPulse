<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-white w-64 fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out z-20">
            <button id="sidebar-close" class="absolute top-4 right-4 text-gray-500 hover:text-gray-600 md:hidden">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <!-- Sidebar content -->
            <div class="flex items-center justify-center h-16 border-b">
                <span class="text-2xl font-bold text-gray-800">PiPulse</span>
            </div>
            {{-- <nav class="mt-5">
                <x-nav-link :href="route('devices.index')" :active="request()->routeIs
                ('devices.index')" class="flex items-center py-3 px-6 text-gray-700 
                hover:bg-gray-100">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" 
                    stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 
                        1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 011-1v-4a1 1 0 
                        011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    {{ __('Dashboard') }}
                </x-nav-link>
                @if(Auth::user()->isAdmin())
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs
                    ('admin.index')" class="flex items-center py-3 px-6 text-gray-700 
                    hover:bg-gray-100">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" 
                        stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 
                            4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 
                            2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        {{ __('Admin Panel') }}
                    </x-nav-link>
                @endif
                <x-nav-link :href="route('api-documentation')" :active="request()
                ->routeIs('api-documentation')" class="flex items-center py-3 px-6 
                text-gray-700 hover:bg-gray-100">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" 
                    stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                        stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 
                        012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 
                        2 0 01-2 2z" />
                    </svg>
                    {{ __('API Documentation') }}
                </x-nav-link>
            </nav> --}}
            <nav class="mt-5">
                {{-- <x-nav-link :href="route('devices.index')" :active="request()->routeIs('devices.index')" 
                    class="flex items-center py-3 px-6 text-gray-700 hover:bg-gray-100 hover:text-gray-900
                    {{ request()->routeIs('devices.index') ? 'bg-indigo-100 text-gray-900 font-semibold' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    {{ __('Dashboard') }}
                </x-nav-link>
                
                @if(Auth::user()->isAdmin())
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" 
                        class="flex items-center py-3 px-6 text-gray-700 hover:bg-gray-100 hover:text-gray-900
                        {{ request()->routeIs('admin.index') ? 'bg-indigo-100 text-gray-900 font-semibold' : '' }}">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        {{ __('Admin Panel') }}
                    </x-nav-link>
                @endif
                
                <x-nav-link :href="route('api-documentation')" :active="request()->routeIs('api-documentation')" 
                    class="flex items-center py-3 px-6 text-gray-700 hover:bg-gray-100 hover:text-gray-900
                    {{ request()->routeIs('api-documentation') ? 'bg-indigo-100 text-gray-900 font-semibold' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ __('API Documentation') }}
                </x-nav-link> --}}
                <x-nav-link :href="route('devices.index')" :active="request()->routeIs('devices.index')" 
                    class="flex items-center py-3 px-6 text-gray-700 hover:bg-gray-100 hover:text-black w-full
                    {{ request()->routeIs('devices.index') ? 'bg-indigo-100 !text-black font-semibold' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    {{ __('Dashboard') }}
                </x-nav-link>
                
                @if(Auth::user()->isAdmin())
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" 
                        class="flex items-center py-3 px-6 text-gray-700 hover:bg-gray-100 hover:text-black w-full
                        {{ request()->routeIs('admin.index') ? 'bg-indigo-100 !text-black font-semibold' : '' }}">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        {{ __('Admin Panel') }}
                    </x-nav-link>
                @endif
                
                <x-nav-link :href="route('api-documentation')" :active="request()->routeIs('api-documentation')" 
                    class="flex items-center py-3 px-6 text-gray-700 hover:bg-gray-100 hover:text-black w-full
                    {{ request()->routeIs('api-documentation') ? 'bg-indigo-100 !text-black font-semibold' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ __('API Documentation') }}
                </x-nav-link>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <button id="sidebar-toggle" class="text-gray-500 hover:text-gray-600 md:hidden">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                    <div class="flex items-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-gray-600 opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out md:hidden"></div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('opacity-0');
            sidebarOverlay.classList.toggle('pointer-events-none');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking a link (for mobile)
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {  // md breakpoint
                    toggleSidebar();
                }
            });
        });

        const sidebarClose = document.getElementById('sidebar-close');
        sidebarClose.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>