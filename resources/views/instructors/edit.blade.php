@extends('layouts.app')

@section('title', 'Editar Instructor')

@section('styles')
<style>
    .neon-card {
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(30, 41, 59, 0.7);
    }
    .cyan-glow-text {
        text-shadow: 0 0 10px rgba(0, 240, 255, 0.5);
    }
</style>
@endsection

@section('content')
<header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
    <div>
        <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Editar <span class="text-brand-accent cyan-glow-text font-headline">Instructor</span></h2>
        <p class="text-sm text-slate-400 font-medium">Modifica los datos de {{ $instructor->name }}.</p>
    </div>
    <div>
        <a href="{{ route('instructors.index') }}" class="bg-slate-900 border border-slate-800 text-slate-300 font-display font-bold px-5 py-2.5 rounded-xl hover:text-brand-accent hover:border-brand-accent transition-all duration-300 flex items-center gap-2 text-sm">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span> Volver
        </a>
    </div>
</header>

<section class="neon-card p-8 rounded-2xl max-w-5xl">
    <form action="{{ route('instructors.update', $instructor->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                        <span class="material-symbols-outlined text-brand-accent text-lg">info</span> 1. Información General
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Nombre Completo</label>
                        <input type="text" name="name" value="{{ old('name', $instructor->name) }}" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email', $instructor->email) }}" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Teléfono</label>
                        <input type="text" name="phone" value="{{ old('phone', $instructor->phone) }}" class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Especialidad</label>
                        <select name="specialty" class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm appearance-none">
                            <option value="">Seleccionar especialidad</option>
                            <option value="Musculación" {{ old('specialty', $instructor->specialty) == 'Musculación' ? 'selected' : '' }}>Musculación</option>
                            <option value="Cardio" {{ old('specialty', $instructor->specialty) == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                            <option value="Crossfit" {{ old('specialty', $instructor->specialty) == 'Crossfit' ? 'selected' : '' }}>Crossfit</option>
                            <option value="Boxeo" {{ old('specialty', $instructor->specialty) == 'Boxeo' ? 'selected' : '' }}>Boxeo</option>
                            <option value="Yoga" {{ old('specialty', $instructor->specialty) == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                            <option value="Nutrición" {{ old('specialty', $instructor->specialty) == 'Nutrición' ? 'selected' : '' }}>Nutrición</option>
                            <option value="Fisioterapia" {{ old('specialty', $instructor->specialty) == 'Fisioterapia' ? 'selected' : '' }}>Fisioterapia</option>
                            <option value="Personalizada" {{ old('specialty', $instructor->specialty) == 'Personalizada' ? 'selected' : '' }}>Personalizada</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Estado</label>
                    <select name="status" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
                        <option value="active" {{ old('status', $instructor->status) == 'active' ? 'selected' : '' }}>Activo</option>
                        <option value="inactive" {{ old('status', $instructor->status) == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>
            
            
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                        <span class="material-symbols-outlined text-brand-accent text-lg">photo_camera</span> 2. Imagen del Instructor
                    </h3>
                </div>

                
                @if($instructor->photo)
                    <div class="mb-4">
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Imagen Actual:</span>
                        <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-brand-accent shadow-[0_0_15px_rgba(0,240,255,0.25)]">
                            <img src="{{ $instructor->photo }}" alt="Foto de {{ $instructor->name }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif

                
                <div class="relative group">
                    <label for="photo_file" class="block">
                        <div class="border-2 border-dashed border-slate-800 hover:border-brand-accent/60 rounded-2xl bg-slate-900/30 p-8 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-300 group shadow-inner min-h-[180px]">
                            
                            
                            <div class="w-12 h-12 rounded-2xl bg-brand-accent/10 border border-brand-accent/20 flex items-center justify-center text-brand-accent shadow-[0_0_15px_rgba(0,240,255,0.1)] mb-3 group-hover:scale-105 transition-transform duration-300">
                                <span class="material-symbols-outlined text-2xl font-bold">cloud_upload</span>
                            </div>
                            
                            
                            <p class="text-xs font-bold text-white tracking-wide">Suelta la foto aquí para cambiarla</p>
                            <p class="text-[10px] text-slate-500 font-medium mt-1">Formatos soportados: JPG, PNG o WEBP (Máx. 2MB)</p>
                            
                            
                            <input type="file" name="photo_file" id="photo_file" accept="image/*" class="hidden">
                            
                            
                            <div id="file-name-preview" class="hidden mt-3 px-3 py-1.5 rounded-lg bg-brand-accent/10 border border-brand-accent/20 text-[10px] font-black uppercase text-brand-accent tracking-widest">
                                Archivo Seleccionado
                            </div>
                        </div>
                    </label>
                </div>

                
                <div class="flex items-center gap-3 py-1">
                    <span class="h-px bg-slate-800 flex-1"></span>
                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest font-display">o ingresa una URL</span>
                    <span class="h-px bg-slate-800 flex-1"></span>
                </div>

                
                <div>
                    <label for="photo_url" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Dirección URL de la Imagen</label>
                    <input type="url" name="photo_url" id="photo_url" value="{{ old('photo_url', $instructor->photo) }}" placeholder="Ej. https://images.unsplash.com/photo-..."
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                </div>
            </div>

        </div>

        
        <div class="border-t border-slate-800/80 pt-6 mt-8 flex justify-end gap-3">
            <a href="{{ route('instructors.index') }}" class="px-6 py-3 border border-slate-800 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all duration-200 text-sm font-bold font-display">
                Cancelar
            </a>
            <button type="submit" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest px-8 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 font-bold font-display text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] font-black">save</span> Actualizar Instructor
            </button>
        </div>
    </form>
</section>

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
@endsection