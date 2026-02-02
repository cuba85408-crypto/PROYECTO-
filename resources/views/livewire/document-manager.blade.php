<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-black italic uppercase text-gray-900 mb-6 border-l-8 border-indigo-600 pl-4">
            Catálogo de Normas ISO @if(auth()->user()->role === 'admin') <span class="text-indigo-600">[MODO ADMIN]</span> @endif
        </h2>

        @if (session()->has('message'))
            <div class="bg-indigo-600 text-white p-4 rounded-xl mb-6 shadow-lg font-bold italic animate-bounce">
                {{ session('message') }}
            </div>
        @endif

        <div class="relative mb-8">
            <input type="text" wire:model.live="search" placeholder="Filtrar por nombre de norma o código..." 
                   class="w-full p-5 rounded-2xl border-none shadow-xl focus:ring-4 focus:ring-indigo-500/20 transition-all font-medium text-gray-700">
            <div class="absolute right-5 top-5 text-gray-400">🔍</div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($documents as $doc)
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-200 hover:shadow-2xl transition-all group relative overflow-hidden">
                    
                    <div class="absolute top-0 right-0 bg-indigo-600 text-white px-4 py-1 rounded-bl-2xl font-black text-[10px] italic">
                        {{ $doc->visitas ?? 0 }} VISTAS
                    </div>

                    <h3 class="text-xl font-black uppercase italic text-gray-800 group-hover:text-indigo-600 transition-colors">
                        {{ $doc->titulo }}
                    </h3>
                    
                    <p class="text-indigo-600 font-black text-3xl my-3">
                        Bs. {{ number_format($doc->precio, 2) }}
                    </p>

                    <div class="flex items-center gap-3 mb-6 bg-indigo-900/5 p-3 rounded-2xl border border-indigo-500/10">
                        <div class="bg-indigo-600 p-2 rounded-lg shadow-lg shadow-indigo-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase text-indigo-400 leading-none tracking-widest">Trazabilidad de Acceso</p>
                            <p class="text-gray-700 font-black text-xs italic">
                                {{ $doc->visitas ?? 0 }} <span class="text-gray-400 text-[10px] not-italic font-medium lowercase">lecturas verificadas</span>
                            </p>
                        </div>
                    </div>

                    <hr class="mb-6 border-gray-100">

                    @php $status = $misPagos[$doc->id] ?? 'bloqueado'; @endphp

                    {{-- LÓGICA DE BOTONES SEGÚN EL ROL --}}
                    @if(auth()->user()->role === 'admin')
                        <div class="bg-gray-100 p-4 rounded-xl text-center border-2 border-dashed border-gray-300">
                            <span class="text-[10px] font-black uppercase text-gray-500 tracking-widest">
                                Gestión desde Dashboard
                            </span>
                        </div>
                    @elseif($status === 'aprobado')
                        <a href="{{ route('ver.documento', $doc->id) }}" 
                           target="_blank" 
                           class="w-full inline-block text-center bg-green-500 hover:bg-green-600 text-white py-4 rounded-2xl font-black uppercase italic tracking-wider transition-all shadow-lg shadow-green-500/30">
                           ✅ ABRIR NORMA ISO
                        </a>
                    @elseif($status === 'pendiente')
                        <button class="w-full bg-orange-400 text-white py-4 rounded-2xl font-black uppercase italic cursor-wait animate-pulse" disabled>
                            ⏳ Verificando Pago...
                        </button>
                    @else
                        <button wire:click="solicitarCompra({{ $doc->id }})" 
                                class="w-full bg-gray-900 hover:bg-indigo-700 text-white py-4 rounded-2xl font-black uppercase italic transition-all shadow-xl shadow-gray-900/20">
                            🔒 PAGO CON QR
                        </button>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- MODAL DE PAGO (SOLO CLIENTES) --}}
        @if($selectedDocId && auth()->user()->role !== 'admin')
            <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-md flex items-center justify-center z-50 p-4">
                <div class="bg-white p-10 rounded-[40px] max-w-sm w-full text-center shadow-2xl border-4 border-white">
                    <h3 class="text-3xl font-black italic uppercase mb-2">Escanea y Paga</h3>
                    <p class="text-indigo-600 font-bold mb-6 italic uppercase text-xs tracking-tighter">Validación instantánea MarvinProyecto</p>
                    
                    <div class="bg-gray-50 p-4 rounded-3xl mb-6 inline-block border-2 border-gray-100">
                        <img src="{{ asset('img/mi_qr.png') }}" class="w-48 h-48 mx-auto rounded-xl">
                    </div>
                    
                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-4 px-4">Sube la captura de tu transferencia para autorizar tu acceso.</p>
                    
                    <input type="file" wire:model="comprobante" class="mb-6 text-xs block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    
                    <div class="flex flex-col gap-3">
                        <button wire:click="subirPago" wire:loading.attr="disabled" class="bg-indigo-600 hover:bg-indigo-500 text-white py-4 rounded-2xl font-black uppercase italic shadow-lg shadow-indigo-500/40 transition-all">
                            <span wire:loading.remove>Enviar Comprobante ➔</span>
                            <span wire:loading>Procesando...</span>
                        </button>
                        <button wire:click="$set('selectedDocId', null)" class="text-red-500 font-black uppercase text-[10px] tracking-widest hover:text-red-700 transition-colors">
                            Cancelar Operación
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>