<nav x-data="{ open: false }" class="bg-black dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo como link para a página inicial -->
                <a href="{{ url('/') }}" style="display: inline-block;">
                    <img src="{{ asset('img/icon.png') }}" alt="Icone" class="logo">
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <nav class="w-100 bg-black text-white d-flex align-items-center">
                        <div class="container-fluid">
                            <ul class="nav justify-content-start">
                                <li class="nav-item">
                                    <a href="/" class="nav-link active text-white d-flex align-items-center link-hover">
                                        <i class="fas fa-home me-2"></i>
                                        <span>Página Inicial</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categorias.index') }}" class="nav-link text-white d-flex align-items-center link-hover">
                                        <i class="fas fa-star me-2"></i>
                                        <span>Categorias</span>
                                    </a>
                                </li>

                                <!-- Exibe "Minha Empresa" apenas se o usuário tiver empresa vinculada e o status não for "pendente" -->
                                @auth
                                @if(!auth()->user()->empresa || (auth()->user()->empresa && auth()->user()->empresa->status !== 'pendente'))
                                        <li class="nav-item">
                                            <a href="{{ route('empresas.create') }}" class="nav-link text-white d-flex align-items-center link-hover">
                                                <i class="fas fa-cog me-2"></i>
                                                <span>Minha Empresa</span>
                                            </a>
                                        </li>
                                    @endif
                                @endauth

                                <!-- Links de administração -->
                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <li class="nav-item">
                                            <a href="{{ route('config') }}" class="nav-link text-white d-flex align-items-center link-hover">
                                                <i class="fas fa-cog me-2"></i>
                                                <span>Administração</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('userempresa.index') }}" class="nav-link text-white d-flex align-items-center link-hover">
                                                <i class="fas fa-cog me-2"></i>
                                                <span>Vincular</span>
                                            </a>
                                        </li>
                                    @endif
                                @endauth

                                <li class="nav-item">
                                    <a href="{{ asset('sobrenos') }}" class="nav-link text-white d-flex align-items-center link-hover">
                                        <i class="fas fa-question-circle me-2"></i>
                                        <span>Sobre Nós</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-dark dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Link para o Perfil -->
                        <a href="{{ route('profile.edit') }}" class="profile-link dropdown-item d-flex align-items-center">
                            <i class="fas fa-user me-2"></i> {{ __('Perfil') }}
                        </a>

                        <!-- Formulário de Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="profile-link dropdown-item d-flex align-items-center">
                                <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Pagina Principal') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('categorias.index')" :active="request()->routeIs('categorias.index')">
                {{ __('Categorias') }}
            </x-responsive-nav-link>

            <!-- Exibe "Minha Empresa" apenas se o usuário tiver empresa vinculada e o status não for "pendente" -->
            @auth
            @if(!auth()->user()->empresa || (auth()->user()->empresa && auth()->user()->empresa->status !== 'pendente'))
                    <x-responsive-nav-link :href="route('empresas.create')" :active="request()->routeIs('empresas.create')">
                        {{ __('Minha Empresa') }}
                    </x-responsive-nav-link>
                @endif
            @endauth

            <!-- Links de administração para admin -->
            @auth
                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('config')" :active="request()->routeIs('config')">
                        {{ __('Administração') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('userempresa.index')" :active="request()->routeIs('userempresa.index')">
                        {{ __('Vincular') }}
                    </x-responsive-nav-link>
                @endif
            @endauth

            <x-responsive-nav-link :href="asset('sobrenos')" :active="request()->routeIs('sobrenos')">
                {{ __('Sobre Nós') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Link para o perfil -->
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-light d-block text-start px-3 py-2 mb-2" role="button">
                    <i class="fas fa-user me-2"></i>{{ __('Perfil') }}
                </a>

                <!-- Formulário de Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger d-block w-100 text-start px-3 py-2">
                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Estilo CSS para garantir que o tamanho da imagem não seja afetado -->
<style>
    .logo {
        max-width: 70px; /* Tamanho desejado para a logo */
        height: auto;
        display: block; /* Mantém a logo alinhada e ajustada no link */
    }

    a img.logo {
        display: block; /* Garante que o tamanho da imagem permaneça consistente dentro do link */
    }

    .profile-link {
        transition: background-color 0.2s ease, transform 0.2s ease;
        background-color: black;
        color: white; /* Também pode alterar a cor do texto para branco */
    }
    
    .profile-link:hover {
        background-color: white;
        color: black; /* Também pode alterar a cor do texto para branco */
    }
   
    .profile-link:active {
        background-color: rgba(0, 0, 0, 0.1); /* Escurece o fundo */
        transform: scale(0.98); /* Leve redução de tamanho para efeito de clique */
    }
</style>

<!-- Adicionando Font Awesome para ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
