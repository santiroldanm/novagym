@extends('layouts.app')

@section('title', 'Registrar Instructor')

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
        <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Registrar <span class="text-brand-accent cyan-glow-text font-headline">Instructor</span></h2>
        <p class="text-sm text-slate-400 font-medium">Agrega un nuevo entrenador al sistema.</p>
    </div>
    <div>
        <a href="{{ route('instructors.index') }}" class="bg-slate-900 border border-slate-800 text-slate-300 font-display font-bold px-5 py-2.5 rounded-xl hover:text-brand-accent hover:border-brand-accent transition-all duration-300 flex items-center gap-2 text-sm">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span> Volver
        </a>
    </div>
</header>

<section class="neon-card p-8 rounded-2xl max-w-2xl">
    <form action="{{ route('instructors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Nombre Completo</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
            </div>
            
            <div>
                <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Teléfono</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
            </div>
            
            <div>
                <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Especialidad</label>
                <select name="specialty" class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm appearance-none">
                    <option value="">Seleccionar especialidad</option>
                    <option value="Musculación" {{ old('specialty') == 'Musculación' ? 'selected' : '' }}>Musculación</option>
                    <option value="Cardio" {{ old('specialty') == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                    <option value="Crossfit" {{ old('specialty') == 'Crossfit' ? 'selected' : '' }}>Crossfit</option>
                    <option value="Boxeo" {{ old('specialty') == 'Boxeo' ? 'selected' : '' }}>Boxeo</option>
                    <option value="Yoga" {{ old('specialty') == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                    <option value="Nutrición" {{ old('specialty') == 'Nutrición' ? 'selected' : '' }}>Nutrición</option>
                    <option value="Fisioterapia" {{ old('specialty') == 'Fisioterapia' ? 'selected' : '' }}>Fisioterapia</option>
                    <option value="Personalizada" {{ old('specialty') == 'Personalizada' ? 'selected' : '' }}>Personalizada</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Foto de Perfil</label>
            <input type="file" name="photo" accept="image/*" class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-display file:font-bold file:bg-brand-accent file:text-brand-darkest hover:file:bg-cyan-400 transition-all duration-300">
            <p class="text-[10px] text-slate-500 mt-2">Formato: jpeg, png, jpg, gif, webp. Máximo 2MB.</p>
        </div>

        <div>
            <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Estado</label>
            <select name="status" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Activo</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold px-6 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 flex items-center gap-2 shadow-[0_0_15px_rgba(0,240,255,0.15)]">
                <span class="material-symbols-outlined text-[20px] font-black">save</span> Registrar Instructor
            </button>
        </div>
    </form>
</section>
@endsection