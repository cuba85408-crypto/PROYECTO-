<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-white italic uppercase tracking-widest">
            SISTEMA DE GESTIÓN <span class="text-blue-500">MARVINPROYECTO</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-[#020617] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(Auth::user()->role === 'admin')
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-[#0f172a] p-8 border-b-8 border-blue-500 shadow-xl rounded-t-lg">
                        <p class="text-gray-400 text-[10px] font-black uppercase italic mb-2">Ventas Netas</p>
                        <p class="text-4xl font-black text-white italic">Bs. {{ \App\Models\Payment::where('status', 'aprobado')->count() * 50 }}</p>
                    </div>
                    
                    <div class="bg-[#0f172a] p-8 border-b-8 border-yellow-500 shadow-xl rounded-t-lg">
                        <p class="text-gray-400 text-[10px] font-black uppercase italic mb-2">Pendientes de Firma</p>
                        <p class="text-4xl font-black text-white italic">{{ \App\Models\Payment::where('status', 'pendiente')->count() }}</p>
                    </div>

                    <a href="{{ route('admin.pagos') }}" class="bg-blue-600 p-8 border-2 border-white flex justify-between items-center group transition hover:bg-white hover:text-blue-600 shadow-xl rounded-lg">
                        <div class="text-white group-hover:text-blue-600">
                            <p class="text-[10px] font-black uppercase italic mb-2">Módulo de Validación</p>
                            <p class="text-xl font-black uppercase italic tracking-tighter">Validar QR ➔</p>
                        </div>
                    </a>

                    <a href="{{ route('historial.pagos') }}" class="bg-indigo-600 p-8 border-2 border-white flex justify-between items-center group transition hover:bg-white hover:text-indigo-600 shadow-xl rounded-lg">
                        <div class="text-white group-hover:text-indigo-600">
                            <p class="text-[10px] font-black uppercase italic mb-2">Caja y Trazabilidad</p>
                            <p class="text-xl font-black uppercase italic tracking-tighter">Historial Global ➔</p>
                        </div>
                    </a>
                </div>

                <div class="bg-[#0f172a] p-8 border-2 border-gray-800 mb-8 overflow-hidden shadow-2xl rounded-xl">
                    <h3 class="text-xl font-black mb-6 border-l-4 border-blue-500 pl-4 text-white italic uppercase">🛡️ Auditoría de Trazabilidad Total</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-800 text-blue-400 text-[10px] font-black uppercase tracking-widest">
                                    <th class="px-4 py-4">Operador</th>
                                    <th class="px-4 py-4">Documento Consultado</th>
                                    <th class="px-4 py-4 text-center">Protocolo IP</th>
                                    <th class="px-4 py-4 text-right">Fecha y Hora de Acceso</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800/50">
                                @foreach(\App\Models\AccessLog::with(['user', 'document'])->latest()->take(7)->get() as $log)
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-4 py-4 font-black uppercase text-[11px] text-white italic">
                                            {{ $log->user->name ?? 'Sistema' }}
                                        </td>
                                        <td class="px-4 py-4 text-blue-400 italic text-[11px]">
                                            {{ $log->document->titulo ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-4 text-center font-mono text-[10px] text-gray-500">
                                            {{ $log->ip_address }}
                                        </td>
                                        <td class="px-4 py-4 text-right font-bold text-blue-500 text-[11px]">
                                            @if($log->created_at)
                                                {{ $log->created_at->timezone('America/La_Paz')->format('d/m/Y | H:i:s') }}
                                            @else
                                                <span class="text-gray-600">Sin Registro</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-[#0f172a] p-8 border-2 border-orange-500 mb-8 shadow-xl rounded-xl">
                    <h3 class="text-xl font-black mb-6 text-orange-500 italic uppercase">👥 Gestión de Personal (6.2)</h3>
                    @livewire('admin-users')
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('documentos') }}" class="bg-indigo-700 border-4 border-white p-10 hover:bg-white group transition shadow-2xl rounded-xl">
                    <h3 class="text-white group-hover:text-indigo-700 text-4xl italic font-black uppercase">Catálogo ISO</h3>
                    <p class="text-indigo-200 group-hover:text-indigo-700 font-bold uppercase text-[10px] tracking-widest mt-2">Acceso a normativas autorizadas</p>
                </a>

                <a href="{{ route('historial.pagos') }}" class="bg-blue-800 border-4 border-white p-10 hover:bg-white group transition shadow-2xl rounded-xl">
                    <h3 class="text-white group-hover:text-blue-800 text-4xl italic font-black uppercase">Mis Pagos</h3>
                    <p class="text-blue-200 group-hover:text-blue-800 font-bold uppercase text-[10px] tracking-widest mt-2">Trazabilidad de compras y facturas</p>
                </a>

                <a href="{{ route('profile.edit') }}" class="bg-gray-800 border-4 border-white p-10 hover:bg-white group transition shadow-2xl rounded-xl">
                    <h3 class="text-white group-hover:text-gray-800 text-4xl italic font-black uppercase">Perfil</h3>
                    <p class="text-gray-400 group-hover:text-gray-800 font-bold uppercase text-[10px] tracking-widest mt-2">Gestión de seguridad y cuenta</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>