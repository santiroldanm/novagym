@extends('layouts.app')

@section('title', 'Nueva Rutina')

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
        <a href="{{ route('routines.index') }}" class="text-brand-accent hover:underline text-xs flex items-center gap-1 font-bold font-display uppercase tracking-widest">
            <span class="material-symbols-outlined text-sm font-bold">arrow_back</span> Volver al Listado
        </a>
    </div>
    <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Diseñar Nueva <span class="text-brand-accent font-headline">Rutina</span></h2>
    <p class="text-sm text-slate-400 font-medium">Establece los objetivos, ejercicios y asigna la rutina a un atleta activo.</p>
</header>

<!-- Form Container -->
<section class="max-w-3xl neon-card p-8 rounded-2xl">
    <form action="{{ route('routines.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Name & Client Selection Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nombre de la Rutina *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Ej. Fuerza Máxima X"
                    class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
            </div>
            
            <div>
                <label for="client_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Asociar Atleta / Socio *</label>
                <select name="client_id" id="client_id" required
                    class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                    <option value="" disabled selected>Selecciona un atleta...</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->name }} ({{ $client->email }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Difficulty Selection -->
        <div>
            <label for="difficulty" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nivel de Dificultad *</label>
            <select name="difficulty" id="difficulty" required
                class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                <option value="beginner" {{ old('difficulty') === 'beginner' ? 'selected' : '' }}>Principiante (Básico)</option>
                <option value="intermediate" {{ old('difficulty', 'intermediate') === 'intermediate' ? 'selected' : '' }}>Intermedio (Medio)</option>
                <option value="advanced" {{ old('difficulty') === 'advanced' ? 'selected' : '' }}>Avanzado (Alto Rendimiento)</option>
            </select>
        </div>

        <!-- Description (Textarea) -->
        <div>
            <label for="description" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Descripción e Instrucciones de la Rutina *</label>
            <textarea name="description" id="description" rows="6" required placeholder="Describe detalladamente las series, repeticiones, descansos y los ejercicios específicos que componen esta rutina de entrenamiento..."
                class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm font-sans leading-relaxed">{{ old('description') }}</textarea>
            <p class="text-[10px] text-slate-500 mt-2 font-medium">Tip: Sé específico con los tiempos de descanso y porcentajes de RM para obtener mejores resultados.</p>
        </div>

        <!-- Submit Buttons -->
        <div class="border-t border-slate-800/80 pt-6 flex justify-end gap-3">
            <a href="{{ route('routines.index') }}" class="px-6 py-3 border border-slate-800 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all duration-200 text-sm font-bold font-display">
                Cancelar
            </a>
            <button type="submit" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest px-8 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 font-bold font-display text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] font-black">save</span> Guardar Rutina
            </button>
        </div>
    </form>
</section>
@endsection
