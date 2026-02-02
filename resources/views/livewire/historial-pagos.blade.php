<div class="p-8 bg-[#020617] min-h-screen">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-black italic uppercase text-white mb-8 border-b-4 border-indigo-600 pb-4">
            💰 Historial de <span class="text-indigo-500">Transacciones</span>
        </h2>

        <div class="bg-[#0f172a] border border-gray-800 rounded-2xl overflow-hidden shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-indigo-900/20 text-indigo-400 text-[10px] uppercase tracking-widest border-b border-gray-800">
                        @if(auth()->user()->role === 'admin') <th class="p-4">Usuario</th> @endif
                        <th class="p-4">Norma ISO</th>
                        <th class="p-4">Monto</th>
                        <th class="p-4 text-center">Estado</th>
                        <th class="p-4 text-right">Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300 text-xs">
                    @forelse($pagos as $pago)
                    <tr class="border-b border-gray-800/50 hover:bg-white/5 transition-all">
                        @if(auth()->user()->role === 'admin')
                            <td class="p-4 font-black text-white uppercase italic">{{ $pago->user->name }}</td>
                        @endif
                        <td class="p-4 italic text-blue-100">{{ $pago->document->titulo }}</td>
                        <td class="p-4 font-bold text-indigo-400">Bs. {{ number_format($pago->document->precio, 2) }}</td>
                        <td class="p-4 text-center">
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase italic 
                                {{ $pago->status === 'aprobado' ? 'bg-green-500/20 text-green-500 border border-green-500/50' : 
                                   ($pago->status === 'rechazado' ? 'bg-red-500/20 text-red-500 border border-red-500/50' : 
                                   'bg-yellow-500/20 text-yellow-500 border border-yellow-500/50 animate-pulse') }}">
                                {{ $pago->status }}
                            </span>
                        </td>
                        <td class="p-4 text-right font-mono text-gray-500">
                            {{ $pago->created_at->timezone('America/La_Paz')->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-20 text-center text-gray-600 uppercase font-black italic">No se registran movimientos financieros</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>