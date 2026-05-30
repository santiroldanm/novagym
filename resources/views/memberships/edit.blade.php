@extends('layouts.app')

@section('title', 'Editar Membresía')

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
    <header class="mb-8">
        <div class="mb-2">
            <a href="{{ route('memberships.index') }}"
                class="text-brand-accent hover:underline text-xs flex items-center gap-1 font-bold font-display uppercase tracking-widest">
                <span class="material-symbols-outlined text-sm font-bold">arrow_back</span> Volver al Listado
            </a>
        </div>
        <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Editar <span
                class="text-brand-accent font-headline">Membresía</span></h2>
        <p class="text-sm text-slate-400 font-medium">Modifica los datos de la membresía de <strong
                class="text-white">{{ $membership->client->name ?? 'N/A' }}</strong>.</p>
    </header>

    <section class="neon-card p-8 rounded-2xl">
        <form action="{{ route('memberships.update', $membership->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <h3
                        class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                        <span class="material-symbols-outlined text-brand-accent text-lg">credit_card</span> Datos de la
                        Membresía
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="client_id"
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Cliente
                            *</label>
                        <select name="client_id" id="client_id" required
                            class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id', $membership->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="plan_name"
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nombre
                            del Plan *</label>
                        <input type="text" name="plan_name" id="plan_name"
                            value="{{ old('plan_name', $membership->plan_name) }}" required
                            class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="plan_type"
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Tipo
                            de Plan *</label>
                        <select name="plan_type" id="plan_type" required
                            class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                            <option value="monthly" {{ old('plan_type', $membership->plan_type) === 'monthly' ? 'selected' : '' }}>Mensual</option>
                            <option value="quarterly" {{ old('plan_type', $membership->plan_type) === 'quarterly' ? 'selected' : '' }}>Trimestral</option>
                            <option value="annual" {{ old('plan_type', $membership->plan_type) === 'annual' ? 'selected' : '' }}>Anual</option>
                            <option value="custom" {{ old('plan_type', $membership->plan_type) === 'custom' ? 'selected' : '' }}>Personalizado</option>
                        </select>
                    </div>
                    <div>
                        <label for="price"
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Precio
                            () *</label>
                        <input type="number" step="0.01" name="price" id="price"
                            value="{{ old('price', $membership->price) }}" required
                            class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                    </div>
                    <div>
                        <label for="status"
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Estado
                            *</label>
                        <select name="status" id="status" required
                            class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                            <option value="active" {{ old('status', $membership->status) === 'active' ? 'selected' : '' }}>
                                Activa</option>
                            <option value="expired" {{ old('status', $membership->status) === 'expired' ? 'selected' : '' }}>
                                Expirada</option>
                            <option value="cancelled" {{ old('status', $membership->status) === 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date"
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Fecha
                            de Inicio *</label>
                        <input type="date" name="start_date" id="start_date"
                            value="{{ old('start_date', $membership->start_date) }}" required
                            class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                    </div>
                    <div>
                        <label for="end_date"
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Fecha
                            de Fin</label>
                        <input type="date" name="end_date" id="end_date"
                            value="{{ old('end_date', $membership->end_date) }}"
                            class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                    </div>
                </div>

                <div>
                    <label for="notes"
                        class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Notas
                        Adicionales</label>
                    <textarea name="notes" id="notes" rows="3"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm resize-none">{{ old('notes', $membership->notes) }}</textarea>
                </div>
            </div>

            <div class="border-t border-slate-800/80 pt-6 mt-8 flex justify-end gap-3">
                <a href="{{ route('memberships.index') }}"
                    class="px-6 py-3 border border-slate-800 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all duration-200 text-sm font-bold font-display">Cancelar</a>
                <button type="submit"
                    class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest px-8 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 font-bold font-display text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px] font-black">save</span> Actualizar Membresía
                </button>
            </div>
        </form>
    </section>
@endsection