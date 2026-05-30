@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('styles')
<style>
    .neon-card {
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(30, 41, 59, 0.7);
    }
    .focus-cyan:focus {
        border-color: #00f0ff !important;
        box-shadow: 0 0 15px rgba(0, 240, 255, 0.2) !important;
    }
</style>
@endsection

@section('content')
<!-- Header Section -->
<header class="mb-8">
    <div class="mb-2">
        <a href="{{ route('clients.index') }}" class="text-brand-accent hover:underline text-xs flex items-center gap-1 font-bold font-display uppercase tracking-widest">
            <span class="material-symbols-outlined text-sm font-bold">arrow_back</span> Volver al Listado
        </a>
    </div>
    <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Editar Cliente: <span class="text-brand-accent font-headline">{{ $client->name }}</span></h2>
    <p class="text-sm text-slate-400 font-medium">Modifica la información básica del socio y actualiza su estatus en el sistema.</p>
</header>

<!-- Main Redesigned Form Area in 2 Columns -->
<section class="neon-card p-8 rounded-2xl">
    <form action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Personal info (7 cols) -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                        <span class="material-symbols-outlined text-brand-accent text-lg">badge</span> 1. Información de Membresía
                    </h3>
                </div>

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nombre Completo *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $client->name) }}" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Correo Electrónico *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                </div>

                <!-- Phone & Status Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Teléfono de Contacto</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $client->phone) }}"
                            class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                    </div>

                    <div>
                        <label for="status" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Estado del Socio *</label>
                        <select name="status" id="status" required
                            class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                            <option value="active" {{ old('status', $client->status) === 'active' ? 'selected' : '' }}>Activo (Alta)</option>
                            <option value="inactive" {{ old('status', $client->status) === 'inactive' ? 'selected' : '' }}>Inactivo (Baja)</option>
                        </select>
                    </div>
                </div>

                <!-- Branch Field -->
                <div>
                    <label for="branch_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Sede de Entrenamiento</label>
                    <select name="branch_id" id="branch_id"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                        <option value="">-- Seleccionar Sede (Opcional) --</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id', $client->branch_id) == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }} - {{ $branch->address }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Right Column: Photograph Dropzone & Review Preview (5 cols) -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                        <span class="material-symbols-outlined text-brand-accent text-lg">photo_camera</span> 2. Imagen del Atleta
                    </h3>
                </div>

                <!-- Photographed Current Preview (If exists) -->
                @if($client->photo)
                <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-900/40 border border-slate-800 shadow-lg">
                    <div class="w-16 h-16 rounded-xl overflow-hidden border-2 border-brand-accent flex-shrink-0 bg-slate-950 shadow-[0_0_12px_rgba(0,240,255,0.2)]">
                        <img src="{{ $client->photo }}" alt="Foto de {{ $client->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-white">Fotografía Actual</p>
                        <p class="text-[10px] text-slate-400 mt-1 leading-normal">Cargada actualmente en la ficha del atleta. Puedes re-emplazarla a continuación.</p>
                    </div>
                </div>
                @endif

                <!-- Dashed Premium Dropzone -->
                <div class="relative group">
                    <label for="photo_file" class="block">
                        <div class="border-2 border-dashed border-slate-800 hover:border-brand-accent/60 rounded-2xl bg-slate-900/30 p-8 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-300 group shadow-inner min-h-[180px]">
                            
                            <!-- Cloud Icon -->
                            <div class="w-12 h-12 rounded-xl bg-brand-accent/10 border border-brand-accent/20 flex items-center justify-center text-brand-accent shadow-[0_0_15px_rgba(0,240,255,0.1)] mb-3 group-hover:scale-105 transition-transform duration-300">
                                <span class="material-symbols-outlined text-2xl font-bold">cloud_upload</span>
                            </div>
                            
                            <!-- Upload Instructions -->
                            <p class="text-xs font-bold text-white tracking-wide">Sube una nueva foto para reemplazar la actual</p>
                            <p class="text-[10px] text-slate-500 font-medium mt-1">Formatos soportados: JPG, PNG o WEBP (Máx. 2MB)</p>
                            
                            <!-- Hidden File Input -->
                            <input type="file" name="photo_file" id="photo_file" accept="image/*" class="hidden">
                            
                            <!-- File Name preview banner -->
                            <div id="file-name-preview" class="hidden mt-4 px-3 py-1.5 rounded-lg bg-brand-accent/10 border border-brand-accent/20 text-[10px] font-black uppercase text-brand-accent tracking-widest">
                                Archivo Seleccionado
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Text Divider -->
                <div class="flex items-center gap-3 py-1">
                    <span class="h-px bg-slate-800 flex-1"></span>
                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest font-display">o ingresa una URL</span>
                    <span class="h-px bg-slate-800 flex-1"></span>
                </div>

                <!-- URL Option -->
                <div>
                    <label for="photo_url" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Dirección URL de la Imagen</label>
                    <input type="url" name="photo_url" id="photo_url" value="{{ old('photo_url', $client->photo) }}" placeholder="Ej. https://images.unsplash.com/photo-..."
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                </div>
            </div>

        </div>

        <!-- Submit Button Grid Footer -->
        <div class="border-t border-slate-800/80 pt-6 mt-8 flex justify-end gap-3">
            <a href="{{ route('clients.index') }}" class="px-6 py-3 border border-slate-800 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all duration-200 text-sm font-bold font-display">
                Cancelar
            </a>
            <button type="submit" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest px-8 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 font-bold font-display text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] font-black">save</span> Actualizar Cliente
            </button>
        </div>
    </form>
</section>
@endsection

@section('scripts')
<script>
    // Visual Dropzone filename preview updater
    document.getElementById('photo_file').addEventListener('change', function(e) {
        const preview = document.getElementById('file-name-preview');
        if (e.target.files && e.target.files.length > 0) {
            const fileName = e.target.files[0].name;
            preview.innerText = `Foto: ${fileName}`;
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    });
</script>
@endsection
