<header class="bg-gray-900 shadow-lg">
    <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <svg class="h-8 w-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
            <span class="text-white text-xl font-bold tracking-tight">TaskManager</span>
        </div>
        
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('tasks.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Dashboard</a>
            <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">Projects</a>
            <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">Team</a>
        </div>

        <div class="flex items-center space-x-4">
            @auth
                <div class="text-gray-300 text-sm italic mr-2">
                    Hello, {{ Auth::user()->name }}
                </div>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium transition duration-200">
                    Logout
                </button>
            @else
                <a href="{{ route('login') }}" class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md font-medium transition duration-200">
                    Login
                </a>
            @endauth
        </div>
    </nav>
</header>
