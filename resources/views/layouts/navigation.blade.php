<nav x-data="{ open: false }" class="bg-black border-b border-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="bg-white text-black font-black px-3 py-1 rounded-lg italic border-2 border-blue-500 shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                            MP
                        </div>
                        <span class="text-white font-black uppercase italic tracking-tighter text-2xl hidden md:block">
                            Marvin<span class="text-blue-500">Proyecto</span>
                        </span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-blue-400 font-black uppercase text-[10px] tracking-widest transition">
                        {{ __('Centro de Control') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('documentos')" :active="request()->routeIs('documentos')" class="text-white hover:text-blue-400 font-black uppercase text-[10px] tracking-widest transition">
                        {{ __('Catálogo ISO') }}
                    </x-nav-link>

                    {{-- Solo se muestra si el rol es admin, pero las rutas ya están desbloqueadas --}}
                    @if(Auth::user()->role == 'admin')
                        <div class="border-l border-gray-800 ml-4 pl-4 flex space-x-8">
                            <x-nav-link :href="route('admin.pagos')" :active="request()->routeIs('admin.pagos')" class="text-green-500 hover:text-green-400 font-black uppercase text-[10px] tracking-widest transition">
                                {{ __('Validar Pagos') }}
                            </x-nav-link>
                            
                            <x-nav-link :href="route('admin.catalogo')" :active="request()->routeIs('admin.catalogo')" class="text-blue-500 hover:text-blue-400 font-black uppercase text-[10px] tracking-widest transition">
                                {{ __('Gestión ISO') }}
                            </x-nav-link>
                        </div>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-bold text-gray-400 hover:text-white transition">
                            <div class="flex flex-col items-end">
                                <span class="leading-none">{{ Auth::user()->name }}</span>
                                <span class="text-[8px] text-blue-500 uppercase tracking-tighter leading-none mt-1">
                                    Nivel: {{ Auth::user()->role }}
                                </span>
                            </div>
                            <div class="ml-1 italic text-xs">▼</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="font-bold uppercase text-xs">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 font-black uppercase text-xs">
                                Cerrar Sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>