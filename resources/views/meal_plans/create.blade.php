@extends('layouts.app')

@section('title', 'Nuevo Plan de Alimentación')

@section('styles')
<style>
    .neon-card { background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(16px); border: 1px solid rgba(30, 41, 59, 0.7); }
    .focus-cyan:focus { border-color: #00f0ff !important; box-shadow: 0 0 15px rgba(0, 240, 255, 0.2) !important; }
</style>
@endsection

@section('content')
<header class="mb-8">
    <div class="mb-2">
        <a href="{{ route('meal-plans.index') }}" class="text-brand-accent hover:underline text-xs flex items-center gap-1 font-bold font-display uppercase tracking-widest">
            <span class="material-symbols-outlined text-sm font-bold">arrow_back</span> Volver al Listado
        </a>
    </div>
    <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Crear Plan de <span class="text-brand-accent font-headline">Alimentación</span></h2>
    <p class="text-sm text-slate-400 font-medium">Diseña un plan nutricional personalizado con macronutrientes específicos.</p>
</header>

<section class="neon-card p-8 rounded-2xl">
    <form action="{{ route('meal-plans.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                    <span class="material-symbols-outlined text-brand-accent text-lg">restaurant</span> 1. Información del Plan
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="client_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Cliente *</label>
                    <select name="client_id" id="client_id" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                        <option value="">Seleccionar cliente...</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nombre del Plan *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Ej. Plan Volumen Invierno"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                    <span class="material-symbols-outlined text-brand-accent text-lg">monitoring</span> 2. Macronutrientes
                </h3>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <label for="calories" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Calorías (kcal)</label>
                    <input type="number" name="calories" id="calories" value="{{ old('calories') }}" placeholder="2500"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                </div>
                <div>
                    <label for="proteins_g" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Proteínas (g)</label>
                    <input type="number" name="proteins_g" id="proteins_g" value="{{ old('proteins_g') }}" placeholder="180"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                </div>
                <div>
                    <label for="carbs_g" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Carbohidratos (g)</label>
                    <input type="number" name="carbs_g" id="carbs_g" value="{{ old('carbs_g') }}" placeholder="300"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                </div>
                <div>
                    <label for="fats_g" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Grasas (g)</label>
                    <input type="number" name="fats_g" id="fats_g" value="{{ old('fats_g') }}" placeholder="70"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                    <span class="material-symbols-outlined text-brand-accent text-lg">description</span> 3. Detalle del Plan
                </h3>
            </div>

            <div>
                <label for="description" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Descripción y Comidas *</label>
                <textarea name="description" id="description" rows="8" required placeholder="Detalla las comidas del día, horarios y porciones..."
                    class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm resize-none">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="border-t border-slate-800/80 pt-6 mt-8 flex justify-end gap-3">
            <a href="{{ route('meal-plans.index') }}" class="px-6 py-3 border border-slate-800 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all duration-200 text-sm font-bold font-display">Cancelar</a>
            <button type="submit" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest px-8 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 font-bold font-display text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] font-black">save</span> Guardar Plan
            </button>
        </div>
    </form>
</section>
@endsection
