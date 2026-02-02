<div class="p-8 bg-[#020617] min-h-screen text-white font-sans">
    <div class="max-w-6xl mx-auto">
        
        <h2 class="text-3xl font-black italic uppercase text-blue-500 mb-8 border-b border-blue-900 pb-4">
            GESTIÓN DE CATÁLOGO <span class="text-white">NORMAS ISO</span>
        </h2>

        @if (session()->has('message'))
            <div class="bg-blue-600/20 border border-blue-500 text-blue-400 p-4 mb-8 text-xs font-black uppercase text-center">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="bg-[#0f172a] p-6 rounded-xl border border-gray-800 h-fit shadow-2xl">
                <h3 class="text-lg font-black uppercase mb-6 text-gray-400">{{ $isEditing ? 'Editar Norma' : 'Nueva Norma' }}</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-500">Título de la Norma</label>
                        <input type="text" wire:model="titulo" class="w-full bg-black border border-gray-700 p-3 text-sm rounded mt-1 focus:border-blue-500 outline-none">
                    </div>
                    
                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-500">Precio de Venta (BS)</label>
                        <input type="number" wire:model="precio" class="w-full bg-black border border-gray-700 p-3 text-sm rounded mt-1 focus:border-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="text-[10px] font-bold uppercase text-gray-500">Archivo Digital (PDF)</label>
                        <input type="file" wire:model="archivo" class="w-full text-xs text-gray-500 mt-2">
                    </div>

                    <button wire:click="guardarDocumento" class="w-full bg-blue-600 hover:bg-blue-400 text-black font-black py-3 rounded uppercase text-xs transition-all shadow-lg shadow-blue-900/20">
                        {{ $isEditing ? 'Guardar Cambios' : 'Añadir al Catálogo +' }}
                    </button>

                    @if($isEditing)
                        <button wire:click="$set('isEditing', false)" class="w-full text-gray-500 text-[10px] uppercase font-bold mt-2 hover:text-white">Cancelar Edición</button>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-2 space-y-4">
                @foreach($documentos as $doc)
                    <div class="bg-[#0f172a] border border-gray-800 p-5 rounded-xl flex justify-between items-center group hover:border-blue-500/50 transition-all">
                        <div>
                            <h4 class="text-xl font-black italic uppercase tracking-tight">{{ $doc->titulo }}</h4>
                            <p class="text-green-500 font-mono font-bold">{{ $doc->precio }} BS</p>
                        </div>
                        
                        <div class="flex gap-2">
                            @if($doc->ruta_archivo)
                                <a href="{{ asset('storage/' . $doc->ruta_archivo) }}" target="_blank" class="bg-gray-800 hover:bg-white hover:text-black p-2 rounded text-[10px] font-black uppercase transition-all">
                                    👁️ ABRIR
                                </a>
                            @endif
                            <button wire:click="editar({{ $doc->id }})" class="bg-blue-900/50 hover:bg-blue-600 p-2 rounded text-[10px] font-black uppercase">Editar</button>
                            <button onclick="confirm('¿Eliminar norma?') || event.stopImmediatePropagation()" wire:click="eliminar({{ $doc->id }})" class="bg-red-900/20 hover:bg-red-600 p-2 rounded text-[10px] font-black uppercase text-red-500 hover:text-white">X</button>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>