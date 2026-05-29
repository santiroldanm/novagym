@extends('layouts.app')

@section('title', 'Nueva Membresía')

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
        <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Nueva <span class="text-brand-accent cyan-glow-text font-headline">Membresía</span></h2>
        <p class="text-sm text-slate-400 font-medium">Registra un plan de membresía para un atleta.</p>
    </div>
    <div>
        <a href="{{ route('memberships.index') }}" class="bg-slate-900 border border-slate-800 text-slate-300 font-display font-bold px-5 py-2.5 rounded-xl hover:text-brand-accent hover:border-brand-accent transition-all duration-300 flex items-center gap-2 text-sm">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span> Volver
        </a>
    </div>
</header>

<section class="neon-card p-8 rounded-2xl max-w-2xl">
    <form action="{{ route('memberships.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Cliente</label>
            <select name="client_id" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm appearance-none">
                <option value="">Seleccionar cliente</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Nombre del Plan</label>
                <input type="text" name="plan_name" value="{{ old('plan_name') }}" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
            </div>
            
            <div>
                <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Tipo de Plan</label>
                <select name="plan_type" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm appearance-none">
                    <option value="monthly" {{ old('plan_type') == 'monthly' ? 'selected' : '' }}>Mensual</option>
                    <option value="quarterly" {{ old('plan_type') == 'quarterly' ? 'selected' : '' }}>Trimestral</option>
                    <option value="annual" {{ old('plan_type') == 'annual' ? 'selected' : '' }}>Anual</option>
                    <option value="custom" {{ old('plan_type') == 'custom' ? 'selected' : '' }}>Personalizado</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Precio</label>
            <input type="number" name="price" value="{{ old('price') }}" required step="0.01" min="0" class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Fecha de Inicio</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
            </div>
            
            <div>
                <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Fecha de Fin</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Instructor Asignado (Opcional)</label>
            <select name="instructor_id" class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm appearance-none">
                <option value="">Sin instructor asignado</option>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Estado</label>
            <select name="status" required class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm">
                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Activa</option>
                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Vencida</option>
                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <div>
            <label class="block text-[11px] font-display font-black text-brand-accent uppercase tracking-widest mb-2">Notas</label>
            <textarea name="notes" rows="3" placeholder="Observaciones adicionales..." class="w-full px-4 py-3 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-sm resize-none">{{ old('notes') }}</textarea>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold px-6 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 flex items-center gap-2 shadow-[0_0_15px_rgba(0,240,255,0.15)]">
                <span class="material-symbols-outlined text-[20px] font-black">save</span> Registrar Membresía
            </button>
        </div>
    </form>
</section>
@endsection