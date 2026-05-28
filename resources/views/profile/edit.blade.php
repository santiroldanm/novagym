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
<!-- Header Section -->
<header class="mb-8">
    <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Mi Perfil <span class="text-brand-accent cyan-glow-text font-headline">Administrativo</span></h2>
    <p class="text-sm text-slate-400 font-medium">Actualiza tu información básica de contacto y gestiona las credenciales de acceso de administrador.</p>
</header>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    
    <!-- Left form container (8 cols on lg) -->
    <div class="lg:col-span-8 neon-card p-8 rounded-2xl">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Personal info -->
            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-2 border-b border-slate-800 pb-2">
                    <span class="material-symbols-outlined text-brand-accent text-lg">info</span> Datos del Perfil
                </h3>
                <p class="text-xs text-slate-400 font-medium mb-4">Actualiza tu nombre de coach/administrador y dirección de correo electrónico principal.</p>
            </div>

            <!-- Name & Email Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nombre de Administrador *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                </div>
                
                <div>
                    <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Dirección de Correo *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                </div>
            </div>

            <!-- Section 2: Password credentials -->
            <div class="pt-6">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-2 border-b border-slate-800 pb-2">
                    <span class="material-symbols-outlined text-brand-accent text-lg">security</span> Actualizar Seguridad
                </h3>
                <p class="text-xs text-slate-400 font-medium mb-4">Rellena estos campos únicamente si deseas modificar tu contraseña de inicio de sesión actual.</p>
            </div>

            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Contraseña Actual</label>
                <input type="password" name="current_password" id="current_password" placeholder="Tu contraseña actual para validar cambios"
                    class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-700 focus:outline-none transition-all duration-300 text-sm">
            </div>

            <!-- New Password & Confirm Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="new_password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nueva Contraseña</label>
                    <input type="password" name="new_password" id="new_password" placeholder="Mínimo 8 caracteres"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-700 focus:outline-none transition-all duration-300 text-sm">
                </div>

                <div>
                    <label for="new_password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Confirmar Nueva Contraseña</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Repite la nueva contraseña"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-700 focus:outline-none transition-all duration-300 text-sm">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="border-t border-slate-800/80 pt-6 mt-8 flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest px-8 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 font-bold font-display text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px] font-black">save</span> Guardar Configuración
                </button>
            </div>
        </form>
    </div>

    <!-- Right Side card info (4 cols on lg) -->
    <div class="lg:col-span-4 neon-card p-6 rounded-2xl flex flex-col items-center text-center relative overflow-hidden group">
        <!-- Ambient radial glow behind card -->
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-brand-accent/5 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-500"></div>
        
        <!-- Large Glowing Profile Avatar -->
        <div class="w-20 h-20 rounded-full bg-brand-accent/10 border-2 border-brand-accent flex items-center justify-center mb-4 mt-4 shadow-[0_0_20px_rgba(0,240,255,0.25)] relative">
            <span class="material-symbols-outlined text-brand-accent text-5xl font-bold select-none">account_circle</span>
        </div>
        
        <h4 class="text-lg font-display font-bold text-white leading-tight">{{ $user->name }}</h4>
        <div class="mt-1 flex items-center gap-1.5 justify-center">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
            <p class="text-[9px] text-emerald-400 font-bold tracking-widest uppercase font-display">Superusuario Administrador</p>
        </div>
        
        <!-- Stats and Details List -->
        <div class="w-full border-t border-slate-800 mt-6 pt-4 space-y-3.5 text-left text-xs">
            <div class="flex justify-between items-center text-slate-400 font-medium">
                <span>Miembro desde:</span>
                <span class="text-white font-bold">{{ $user->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="flex justify-between items-center text-slate-400 font-medium">
                <span>Email registrado:</span>
                <span class="text-white font-bold truncate max-w-[180px]">{{ $user->email }}</span>
            </div>
            <div class="flex justify-between items-center text-slate-400 font-medium">
                <span>Clientes asociados:</span>
                <span class="text-brand-accent font-black font-display text-sm">{{ $user->clients()->count() }}</span>
            </div>
        </div>
    </div>

</div>
@endsection
