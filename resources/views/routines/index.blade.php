@extends('layouts.app')

@section('title', 'Rutinas')

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
<!-- Header Section -->
<header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
    <div>
        <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Diseño de <span class="text-brand-accent cyan-glow-text font-headline">Rutinas</span></h2>
        <p class="text-sm text-slate-400 font-medium">Crea, asocia y audita los planes de entrenamiento deportivo y progresión física.</p>
    </div>
    <div>
        <a href="{{ route('routines.create') }}" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold px-5 py-2.5 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 flex items-center gap-2 shadow-[0_0_15px_rgba(0,240,255,0.15)] text-sm">
            <span class="material-symbols-outlined text-[20px] font-black">add_circle</span> Crear Rutina
        </a>
    </div>
</header>

<!-- Main Cards Container -->
@if($routines->isEmpty())
<section class="neon-card p-12 rounded-2xl text-center flex flex-col items-center justify-center border border-dashed border-slate-800">
    <span class="material-symbols-outlined text-slate-600 text-6xl mb-4">fitness_center</span>
    <h3 class="text-lg font-bold text-white mb-1">Sin Rutinas Diseñadas</h3>
    <p class="text-xs text-slate-400 max-w-sm mb-6">Comienza creando tu primera rutina deportiva y asígnala a un atleta.</p>
    <a href="{{ route('routines.create') }}" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold px-5 py-2.5 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] transition-all duration-300 flex items-center gap-2 text-xs">
        <span class="material-symbols-outlined text-[18px]">add_circle</span> Crear Rutina
    </a>
</section>
@else
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($routines as $routine)
    <div class="neon-card p-6 rounded-2xl flex flex-col justify-between hover:scale-[1.02] hover:shadow-[0_0_25px_rgba(0,240,255,0.12)] border border-brand-border hover:border-brand-accent/40 transition-all duration-300 relative group overflow-hidden">
        <!-- Glass effect overlay -->
        <div class="absolute inset-0 bg-gradient-to-tr from-brand-accent/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
        
        <div>
            <!-- Upper Header Row -->
            <div class="flex justify-between items-start gap-2 mb-4">
                <!-- Badge Dificultad -->
                <div>
                    @if($routine->difficulty === 'advanced')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-950/40 text-red-400 border border-red-900/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 shadow-[0_0_6px_#ef4444]"></span> Avanzado
                        </span>
                    @elseif($routine->difficulty === 'intermediate')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-950/40 text-amber-400 border border-amber-900/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shadow-[0_0_6px_#f59e0b]"></span> Intermedio
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-cyan-950/40 text-brand-accent border border-brand-accent/30 shadow-[0_0_10px_rgba(0,240,255,0.1)]">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-accent shadow-[0_0_6px_#00f0ff]"></span> Principiante
                        </span>
                    @endif
                </div>

                <!-- Icon decoration -->
                <div class="text-brand-accent/40 group-hover:text-brand-accent transition-colors duration-300">
                    <span class="material-symbols-outlined text-2xl font-black">fitness_center</span>
                </div>
            </div>

            <!-- Routine name (imponente) -->
            <h3 class="text-xl font-headline font-black text-white tracking-tight leading-tight group-hover:text-brand-accent transition-colors duration-300 mb-2 truncate" title="{{ $routine->name }}">
                {{ $routine->name }}
            </h3>

            <!-- Client detail -->
            <div class="mb-4 flex items-center gap-2">
                <span class="text-xs text-slate-400 font-medium">Asignado a:</span>
                @if($routine->client)
                    <a href="{{ route('clients.edit', $routine->client->id) }}" class="text-xs font-semibold text-brand-accent hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">account_circle</span>
                        <span>{{ $routine->client->name }}</span>
                    </a>
                @else
                    <span class="text-xs text-slate-500 italic">Socio no asignado</span>
                @endif
            </div>

            <!-- Description (Formatted) -->
            <p class="text-xs text-slate-400 font-medium leading-relaxed mb-6 line-clamp-3" title="{{ $routine->description }}">
                {{ $routine->description }}
            </p>
        </div>

        <!-- Action buttons row -->
        <div class="flex items-center justify-between border-t border-brand-border/60 pt-4 mt-auto gap-3 relative z-10">
            <!-- Edit/Delete grouped -->
            <div class="flex gap-2">
                <!-- Edit Button -->
                <a href="{{ route('routines.edit', $routine->id) }}" class="w-9 h-9 flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-brand-accent hover:border-brand-accent hover:shadow-[0_0_10px_rgba(0,240,255,0.25)] rounded-lg transition-all duration-200" title="Editar Rutina">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                </a>
                
                <!-- Delete Button -->
                <form action="{{ route('routines.destroy', $routine->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta rutina?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-9 h-9 flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-red-400 hover:border-red-500/50 hover:shadow-[0_0_10px_rgba(239,68,68,0.25)] rounded-lg transition-all duration-200" title="Eliminar Rutina">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                    </button>
                </form>
            </div>

            <!-- Highlighted PDF Download Button -->
            <a href="{{ route('routines.pdf', $routine->id) }}" class="bg-gradient-to-r from-brand-accent to-cyan-600 hover:from-brand-accent hover:to-cyan-500 text-brand-darkest font-display font-bold px-4 py-2 rounded-xl flex items-center gap-1.5 text-xs hover:shadow-[0_0_15px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300">
                <span class="material-symbols-outlined text-[16px] font-black pointer-events-none">download</span> Descargar PDF
            </a>
        </div>
    </div>
    @endforeach
</section>
@endif
@endsection
