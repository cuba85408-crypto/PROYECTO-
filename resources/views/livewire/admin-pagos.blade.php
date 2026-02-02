<div class="p-8 bg-[#020617] min-h-screen text-white font-sans">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-3xl font-black italic text-green-500 mb-10 border-b border-green-900 pb-4 uppercase">
            SISTEMA DE CONCILIACIÓN BANCARIA
        </h2>

        @if (session()->has('message'))
            <div class="bg-blue-600/20 border border-blue-500 text-blue-400 p-4 mb-8 font-black uppercase text-center">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid gap-4">
            @forelse($pagos as $pago)
                <div class="bg-[#0f172a] border border-gray-800 p-6 rounded-xl shadow-2xl">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="flex-1 space-y-2">
                            <p class="text-[10px] text-green-500 font-bold italic">ISO: {{ $pago->document->titulo ?? 'N/A' }}</p>
                            <h3 class="text-2xl font-black italic">{{ $pago->user->name }}</h3>
                            <div class="grid grid-cols-2 gap-4 text-[11px] font-mono text-gray-400">
                                <p>🏦 {{ $pago->banco_origen }}</p>
                                <p>🔢 {{ $pago->nro_operacion }}</p>
                            </div>
                        </div>
                        <div class="bg-black/40 p-4 rounded-lg border border-gray-800 text-center min-w-[200px]">
                            <p class="text-[10px] text-gray-500 uppercase font-black">Monto Verificado</p>
                            <p class="text-3xl font-black text-green-500 mb-4">{{ $pago->monto_detectado }}</p>
                            <button wire:click="aprobarPago({{ $pago->id }})" class="w-full bg-green-600 hover:bg-green-400 text-black font-black py-2 text-[10px] uppercase rounded mb-2">CONFIRMAR</button>
                            <button wire:click="rechazarPago({{ $pago->id }})" class="w-full bg-transparent border border-red-900 text-red-500 font-bold py-1 text-[9px] uppercase hover:bg-red-900/20">RECHAZAR</button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center py-20 text-gray-600 italic uppercase font-black">Sin depósitos por verificar</p>
            @endforelse
        </div>
    </div>
</div>