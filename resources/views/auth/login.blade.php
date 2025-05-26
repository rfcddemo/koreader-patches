<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-info mb-6 bg-blue-50 border-blue-200 text-blue-800 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-blue-600 shrink-0 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium">{{ session('status') }}</span>
        </div>
    @endif

    <!-- Welcome Message -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Connexion</h2>
        <p class="text-slate-600 text-sm">Accédez à votre espace de gestion des investisseurs</p>
    </div>

    <form method="POST" action="{{ route('login') }}"
          x-data="{ isLoading: false, showPassword: false }"
          @submit="isLoading = true"
          class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="form-control">
            <label class="label pb-2" for="email">
                <span class="label-text font-semibold text-slate-700 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                    Adresse Email
                </span>
            </label>
            <div class="relative">
                <input
                    id="email"
                    class="input input-bordered w-full h-12 pl-12 bg-white border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 @error('email') border-red-400 focus:border-red-500 focus:ring-red-500/20 @enderror"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="prenom.nom@bankofafrica.com"
                />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            @error('email')
            <label class="label pt-1">
                    <span class="label-text-alt text-red-500 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </span>
            </label>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-control">
            <label class="label pb-2" for="password">
                <span class="label-text font-semibold text-slate-700 flex items-center">
                    <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Mot de passe
                </span>
            </label>
            <div class="relative">
                <input
                    id="password"
                    class="input input-bordered w-full h-12 pl-12 pr-12 bg-white border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 @error('password') border-red-400 focus:border-red-500 focus:ring-red-500/20 @enderror"
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••••••"
                />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <button
                    type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors"
                    @click="showPassword = !showPassword"
                >
                    <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    </svg>
                </button>
            </div>
            @error('password')
            <label class="label pt-1">
                    <span class="label-text-alt text-red-500 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </span>
            </label>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-control">
            <label class="label cursor-pointer justify-start py-3">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="checkbox checkbox-primary border-slate-300 rounded-md"
                    name="remember"
                />
                <span class="label-text ml-3 text-slate-700 font-medium">Se souvenir de moi</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button
                type="submit"
                class="btn w-full h-12 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 border-0 text-white font-semibold text-base rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                :class="{ 'loading': isLoading }"
                :disabled="isLoading"
            >
                <span x-show="!isLoading" class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Se connecter
                </span>
                <span x-show="isLoading" class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Connexion en cours...
                </span>
            </button>
        </div>

        <!-- Forgot Password Link -->
        @if (Route::has('password.request'))
            <div class="text-center pt-4">
                <a class="text-blue-600 hover:text-blue-700 text-sm font-medium inline-flex items-center transition-colors duration-200"
                   href="{{ route('password.request') }}">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Mot de passe oublié ?
                </a>
            </div>
        @endif
    </form>

    <!-- Help Section -->
    <div class="mt-8 p-4 bg-slate-50 rounded-xl border border-slate-200">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h3 class="text-sm font-semibold text-slate-800 mb-1">Besoin d'aide ?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Pour obtenir un accès ou en cas de problème de connexion, contactez la
                    <span class="font-medium text-blue-600">Direction de la Communication Financière</span>
                    ou votre administrateur système.
                </p>
            </div>
        </div>
    </div>

    <!-- Demo Credentials (à supprimer en production) -->
    <div class="mt-4 p-4 bg-amber-50 rounded-xl border border-amber-200">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.728-.833-2.498 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <div>
                <h3 class="text-sm font-semibold text-amber-800 mb-1">Comptes de démonstration</h3>
                <div class="text-xs text-amber-700 space-y-1">
                    <p><strong>Admin:</strong> admin@bankofafrica.com / password123</p>
                    <p><strong>Éditeur:</strong> houda@bankofafrica.com / password123</p>
                    <p><strong>Lecture:</strong> ahmed@bankofafrica.com / password123</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
