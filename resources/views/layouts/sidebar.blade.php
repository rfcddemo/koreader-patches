<div class="h-full bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white shadow-xl">
    <!-- Logo Section -->
    <div class="flex items-center justify-center h-16 bg-slate-800/50 border-b border-slate-700/50">
        <div class="flex items-center space-x-3" :class="{ 'justify-center': sidebarCollapsed }">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
            <div x-show="!sidebarCollapsed" class="transition-opacity duration-200">
                <h1 class="font-bold text-lg">BOA CRM</h1>
                <p class="text-xs text-slate-300">Investisseurs</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-8 px-4">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed" class="ml-3 transition-opacity duration-200">Dashboard</span>
                </a>
            </li>

            <!-- Investisseurs -->
            <li x-data="{ investorsOpen: {{ request()->routeIs('investors.*') ? 'true' : 'false' }} }">
                <button @click="investorsOpen = !investorsOpen"
                        class="flex items-center w-full px-3 py-2 rounded-lg transition-colors duration-200 text-slate-300 hover:bg-slate-700 hover:text-white">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed" class="ml-3 flex-1 text-left transition-opacity duration-200">Investisseurs</span>
                    <svg x-show="!sidebarCollapsed" :class="{ 'rotate-90': investorsOpen }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <div x-show="investorsOpen && !sidebarCollapsed"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="ml-8 mt-2 space-y-1">
                    <a href="#"
                       class="flex items-center px-3 py-2 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('investors.index') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        Liste des investisseurs
                    </a>
                    <a href="#"
                       class="flex items-center px-3 py-2 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('investors.create') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        Ajouter un investisseur
                    </a>
                </div>
            </li>

            <!-- Interactions -->
            <li>
                <a href="#"
                   class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->routeIs('interactions.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed" class="ml-3 transition-opacity duration-200">Interactions</span>
                </a>
            </li>

            <!-- Emails -->
            <li>
                <a href="#"
                   class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->routeIs('emails.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed" class="ml-3 transition-opacity duration-200">Emails</span>
                </a>
            </li>

            <!-- Rapports -->
            <li>
                <a href="#"
                   class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ request()->routeIs('reports.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed" class="ml-3 transition-opacity duration-200">Rapports</span>
                </a>
            </li>

            <!-- Divider -->
            <li class="pt-4">
                <hr class="border-slate-700">
            </li>

            <!-- Administration (Admin uniquement) -->
            @role('Administrateur')
            <li x-data="{ adminOpen: {{ request()->routeIs('admin.*') ? 'true' : 'false' }} }">
                <button @click="adminOpen = !adminOpen"
                        class="flex items-center w-full px-3 py-2 rounded-lg transition-colors duration-200 text-slate-300 hover:bg-slate-700 hover:text-white">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span x-show="!sidebarCollapsed" class="ml-3 flex-1 text-left transition-opacity duration-200">Administration</span>
                    <svg x-show="!sidebarCollapsed" :class="{ 'rotate-90': adminOpen }" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <div x-show="adminOpen && !sidebarCollapsed"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="ml-8 mt-2 space-y-1">
                    <a href="#"
                       class="flex items-center px-3 py-2 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        Utilisateurs
                    </a>
                    <a href="#"
                       class="flex items-center px-3 py-2 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('admin.logs.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-700 hover:text-white' }}">
                        Logs système
                    </a>
                </div>
            </li>
            @endrole
        </ul>
    </nav>

    <!-- User Info (au bas de la sidebar) -->
    <div class="absolute bottom-4 left-4 right-4">
        <div class="flex items-center space-x-3 p-3 bg-slate-800/50 rounded-lg" :class="{ 'justify-center': sidebarCollapsed }">
            <img class="h-8 w-8 rounded-full object-cover flex-shrink-0"
                 src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nom_complet) }}&color=ffffff&background=2563eb"
                 alt="{{ auth()->user()->nom_complet }}">
            <div x-show="!sidebarCollapsed" class="flex-1 min-w-0 transition-opacity duration-200">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->nom_complet }}</p>
                <p class="text-xs text-slate-400 truncate">
                    @if(auth()->user()->hasRole('Administrateur'))
                        Administrateur
                    @elseif(auth()->user()->hasRole('Éditeur'))
                        Éditeur
                    @else
                        Lecture seule
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
