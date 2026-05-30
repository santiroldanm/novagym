@extends('layouts.app')

@section('title', 'Editar Sede')

@section('styles')
<style>
    .neon-card { background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(16px); border: 1px solid rgba(30, 41, 59, 0.7); }
    .focus-cyan:focus { border-color: #00f0ff !important; box-shadow: 0 0 15px rgba(0, 240, 255, 0.2) !important; }
</style>
@endsection

@section('content')
<header class="mb-8">
    <div class="mb-2">
        <a href="{{ route('branches.index') }}" class="text-brand-accent hover:underline text-xs flex items-center gap-1 font-bold font-display uppercase tracking-widest">
            <span class="material-symbols-outlined text-sm font-bold">arrow_back</span> Volver al Listado
        </a>
    </div>
    <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Editar <span class="text-brand-accent font-headline">Sede</span></h2>
    <p class="text-sm text-slate-400 font-medium">Modifica la información de la sucursal <strong class="text-white">{{ $branch->name }}</strong>.</p>
</header>

<section class="neon-card p-8 rounded-2xl">
    <form action="{{ route('branches.update', $branch->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-6">
            <div>
                <h3 class="text-sm font-bold text-white flex items-center gap-2 uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">
                    <span class="material-symbols-outlined text-brand-accent text-lg">domain</span> Información de la Sede
                </h3>
            </div>

            <div>
                <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nombre de la Sede *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $branch->name) }}" required
                    class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
            </div>

            <div>
                <label for="address" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Dirección Completa</label>
                <input type="text" name="address" id="address" value="{{ old('address', $branch->address) }}"
                    class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="phone" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $branch->phone) }}"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                </div>
                <div>
                    <label for="schedule" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Horario de Operación</label>
                    <input type="text" name="schedule" id="schedule" value="{{ old('schedule', $branch->schedule) }}"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-600 focus:outline-none transition-all duration-300 text-sm">
                </div>
                <div>
                    <label for="status" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Estado *</label>
                    <select name="status" id="status" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white focus:outline-none transition-all duration-300 text-sm">
                        <option value="active" {{ old('status', $branch->status) === 'active' ? 'selected' : '' }}>Activa</option>
                        <option value="inactive" {{ old('status', $branch->status) === 'inactive' ? 'selected' : '' }}>Inactiva</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-800/80 pt-6 mt-8 flex justify-end gap-3">
            <a href="{{ route('branches.index') }}" class="px-6 py-3 border border-slate-800 text-slate-400 hover:text-white hover:bg-slate-900 rounded-xl transition-all duration-200 text-sm font-bold font-display">Cancelar</a>
            <button type="submit" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest px-8 py-3 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 font-bold font-display text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px] font-black">save</span> Actualizar Sede
            </button>
        </div>
    </form>
</section>
@endsection
