<div class="p-8 max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-black text-gray-800 uppercase italic">🛡️ Gestión y Auditoría de Usuarios</h2>
    </div>

    {{-- Mensajes de éxito --}}
    @if (session()->has('message'))
        <div class="bg-indigo-600 text-white p-4 rounded-2xl mb-6 shadow-lg flex items-center">
            <span class="mr-2">🔔</span>
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="p-5 font-bold text-gray-600 uppercase text-xs">Nombre del Usuario</th>
                    <th class="p-5 font-bold text-gray-600 uppercase text-xs">Correo Electrónico</th>
                    <th class="p-5 font-bold text-gray-600 uppercase text-xs text-center">Estado</th>
                    <th class="p-5 font-bold text-gray-600 uppercase text-xs text-center">Acciones de Seguridad</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="p-5">
                        <p class="font-bold text-gray-800">{{ $user->name }}</p>
                    </td>
                    <td class="p-5 text-gray-500 font-medium">
                        {{ $user->email }}
                    </td>
                    <td class="p-5 text-center">
                        @if($user->status == 1)
                            <span class="inline-flex items-center bg-green-100 text-green-700 px-4 py-1 rounded-full text-xs font-black uppercase">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Activo
                            </span>
                        @else
                            <span class="inline-flex items-center bg-red-100 text-red-700 px-4 py-1 rounded-full text-xs font-black uppercase">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span> De Baja
                            </span>
                        @endif
                    </td>
                    <td class="p-5 text-center">
                        {{-- Botón dinámico que activa la lógica en el componente --}}
                        <button wire:click="toggleStatus({{ $user->id }})" 
                                class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition transform active:scale-95 {{ $user->status ? 'bg-red-50 text-red-600 hover:bg-red-600 hover:text-white' : 'bg-green-50 text-green-600 hover:bg-green-600 hover:text-white border border-green-200' }}">
                            {{ $user->status ? '🚫 Dar de Baja' : '✅ Reactivar' }}
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>