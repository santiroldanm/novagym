@extends('layouts.app')

@section('title', 'Planes de Alimentación')

@section('styles')
<style>
    .neon-card { background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(16px); border: 1px solid rgba(30, 41, 59, 0.7); }
    .cyan-glow-text { text-shadow: 0 0 10px rgba(0, 240, 255, 0.5); }
</style>
@endsection

@section('content')
<header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
    <div>
        <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Planes de <span class="text-brand-accent cyan-glow-text font-headline">Alimentación</span></h2>
        <p class="text-sm text-slate-400 font-medium">Diseña y gestiona planes nutricionales personalizados para cada atleta.</p>
    </div>
    <div>
        <a href="{{ route('meal-plans.create') }}" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold px-5 py-2.5 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 flex items-center gap-2 shadow-[0_0_15px_rgba(0,240,255,0.15)] text-sm">
            <span class="material-symbols-outlined text-[20px] font-black">restaurant</span> Nuevo Plan
        </a>
    </div>
</header>

<section class="neon-card p-6 rounded-2xl">
    <div class="flex flex-col md:flex-row gap-4 mb-6 justify-between items-center bg-brand-dark/45 p-4 rounded-2xl border border-brand-border/60">
        <div class="relative w-full md:w-80">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg select-none">search</span>
            <input type="text" id="customSearchInput" placeholder="Buscar por nombre del plan o cliente..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-brand-darkest border border-brand-border text-white placeholder-slate-500 focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-xs">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="mealPlansTable" class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-800">
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Plan</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Cliente</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Instructor</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display text-center">Calorías</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display text-center">Macros (P/C/G)</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mealPlans as $plan)
                <tr class="border-b border-slate-800/40 hover:bg-slate-800/30 transition-all duration-200">
                    <td class="py-4 px-6 font-display font-bold text-sm text-white">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-emerald-400 text-lg">nutrition</span>
                            {{ $plan->name }}
                        </div>
                    </td>
                    <td class="py-4 px-6 text-sm text-slate-300">{{ $plan->client->name ?? 'N/A' }}</td>
                    <td class="py-4 px-6 text-sm text-slate-300">{{ $plan->instructor->name ?? 'Staff NovaGym' }}</td>
                    <td class="py-4 px-6 text-center">
                        <span class="text-sm font-black text-amber-400 font-display">{{ $plan->calories ?? '—' }}</span>
                        <span class="text-[10px] text-slate-500"> kcal</span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2 text-[11px] font-bold">
                            <span class="text-blue-400">{{ $plan->proteins_g ?? '—' }}p</span>
                            <span class="text-slate-600">/</span>
                            <span class="text-amber-400">{{ $plan->carbs_g ?? '—' }}c</span>
                            <span class="text-slate-600">/</span>
                            <span class="text-red-400">{{ $plan->fats_g ?? '—' }}g</span>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            
                            <a href="{{ route('meal-plans.pdf', $plan->id) }}" class="w-9 h-9 flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-emerald-400 hover:border-emerald-500/50 hover:shadow-[0_0_10px_rgba(52,211,153,0.25)] rounded-lg transition-all duration-200" title="Descargar PDF">
                                <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                            </a>
                            
                            <a href="{{ route('meal-plans.edit', $plan->id) }}" class="w-9 h-9 flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-brand-accent hover:border-brand-accent hover:shadow-[0_0_10px_rgba(0,240,255,0.25)] rounded-lg transition-all duration-200" title="Editar">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            
                            <form action="{{ route('meal-plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este plan de alimentación?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-red-400 hover:border-red-500/50 hover:shadow-[0_0_10px_rgba(239,68,68,0.25)] rounded-lg transition-all duration-200" title="Eliminar">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const table = $('#mealPlansTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' },
            pageLength: 10, ordering: true, responsive: true, dom: 'tpr',
            columnDefs: [{ orderable: false, targets: [5] }]
        });
        $('#customSearchInput').on('keyup', function() { table.search(this.value).draw(); });
    });
</script>
@endsection
