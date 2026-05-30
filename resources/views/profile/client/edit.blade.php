@extends('layouts.app')

@section('title', 'Mi Perfil')

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
    .cyan-glow-text {
        text-shadow: 0 0 10px rgba(0, 240, 255, 0.5);
    }
</style>
@endsection

@section('content')

<header class="mb-8">
    <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Mi Perfil <span class="text-brand-accent cyan-glow-text font-headline">Cliente</span></h2>
    <p class="text-sm text-slate-400 font-medium">Actualiza tu información de cliente y gestiona tus credenciales de acceso.</p>
</header>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    
    
    <div class="lg:col-span-8 neon-card p-8 rounded-2xl">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            
            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-2 border-b border-slate-800 pb-2">
                    <span class="material-symbols-outlined text-brand-accent text-lg">info</span> Datos del Perfil
                </h3>
                <p class="text-xs text-slate-400 font-medium mb-4">Actualiza tu nombre, correo electrónico y teléfono.</p>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nombre *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $profile->name) }}" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                </div>
                
                <div>
                    <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Correo Electrónico *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                </div>
            </div>

            
            <div class="mt-4">
                <label for="phone" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Teléfono</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $profile->phone) }}"
                    class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
            </div>

            
            <div class="pt-6">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-2 border-b border-slate-800 pb-2">
                    <span class="material-symbols-outlined text-brand-accent text-lg">image</span> Fotografía de Perfil
                </h3>
                <p class="text-xs text-slate-400 font-medium mb-4">Actualiza tu foto de perfil subiendo un archivo o proporcionando una URL externa.</p>
            </div>

            
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <label for="photo_file" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Subir Foto</label>
                    <input type="file" name="photo_file" id="photo_file"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                </div>
                
                <div class="flex items-center space-x-3">
                    <label for="photo_url" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">URL de Foto</label>
                    <input type="url" name="photo_url" id="photo_url" value="{{ old('photo_url', $profile->photo) }}"
                        placeholder="https://ejemplo.com/foto.jpg"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                </div>
                
                @if($profile->photo)
                    <div class="mt-4">
                        <div class="flex items-center space-x-3">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Vista Previa:</span>
                            <img src="{{ $profile->photo }}" alt="Vista previa" class="w-16 h-16 rounded-full border-2 border-brand-accent object-cover">
                        </div>
                    </div>
                @endif
            </div>

            
            <div class="pt-6">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-2 border-b border-slate-800 pb-2">
                    <span class="material-symbols-outlined text-brand-accent text-lg">check_circle</span> Estado de Cuenta
                </h3>
                <p class="text-xs text-slate-400 font-medium mb-4">Actualiza tu estado de cuenta en la plataforma.</p>
            </div>

            
            <div class="space-y-3">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <input type="radio" name="status" id="status_active" value="active" 
                            {{ old('status', $profile->status) == 'active' ? 'checked' : '' }}
                            class="focus-cyan h-4 w-4 text-brand-accent bg-slate-900 border-slate-800 rounded">
                        <label for="status_active" class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Activo</label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="radio" name="status" id="status_inactive" value="inactive" 
                            {{ old('status', $profile->status) == 'inactive' ? 'checked' : '' }}
                            class="focus-cyan h-4 w-4 text-brand-accent bg-slate-900 border-slate-800 rounded">
                        <label for="status_inactive" class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Inactivo</label>
                    </div>
                </div>
            </div>

            
            <div class="border-t border-slate-800/80 pt-6 mt-8 flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest px-8 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 font-bold font-display text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px] font-black">save</span> Guardar Configuración
                </button>
            </div>
        </form>
    </div>

    
    <div class="lg:col-span-4 neon-card p-6 rounded-2xl flex flex-col items-center text-center relative overflow-hidden group">
        
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-brand-accent/5 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-500"></div>
        
        
        <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-brand-accent flex items-center justify-center mb-4 mt-4 shadow-[0_0_20px_rgba(0,240,255,0.25)] relative bg-brand-accent/10">
            @if($profile->photo)
                <img src="{{ $profile->photo }}" alt="{{ $profile->name }}" class="w-full h-full object-cover">
            @else
                <span class="material-symbols-outlined text-brand-accent text-5xl font-bold select-none">person</span>
            @endif
        </div>
        
        <h4 class="text-lg font-display font-bold text-white leading-tight">{{ $profile->name }}</h4>
        <div class="mt-1 flex items-center gap-1.5 justify-center">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <p class="text-[9px] text-emerald-400 font-bold tracking-widest uppercase font-display">Cliente Activo</p>
        </div>
        
        
        <div class="w-full border-t border-slate-800 mt-6 pt-4 space-y-3.5 text-left text-xs">
            <div class="flex justify-between items-center text-slate-400 font-medium">
                <span>Cliente desde:</span>
                <span class="text-white font-bold">{{ $profile->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="flex justify-between items-center text-slate-400 font-medium">
                <span>Email registrado:</span>
                <span class="text-white font-bold truncate max-w-[180px]">{{ $profile->email }}</span>
            </div>
            <div class="flex justify-between items-center text-slate-400 font-medium">
                <span>Rutinas asignadas:</span>
                <span class="text-brand-accent font-black font-display text-sm>{{ $routinesCount }}</span>
            </div>
        </div>
    </div>
    
</div>
@endsection