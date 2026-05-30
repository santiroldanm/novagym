@extends('layouts.app')

@section('title', 'Membresías')

@section('styles')
<style>
    .neon-card { background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(16px); border: 1px solid rgba(30, 41, 59, 0.7); }
    .cyan-glow-text { text-shadow: 0 0 10px rgba(0, 240, 255, 0.5); }
</style>
@endsection

@section('content')
<header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
    <div>
        <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Gestión de <span class="text-brand-accent cyan-glow-text font-headline">Membresías</span></h2>
        <p class="text-sm text-slate-400 font-medium">Control de planes, pagos y vigencia de las membresías de los socios.</p>
    </div>
    <div>
        <a href="{{ route('memberships.create') }}" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold px-5 py-2.5 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 flex items-center gap-2 shadow-[0_0_15px_rgba(0,240,255,0.15)] text-sm">
            <span class="material-symbols-outlined text-[20px] font-black">card_membership</span> Nueva Membresía
        </a>
    </div>
</header>

<section class="neon-card p-6 rounded-2xl">
    <div class="flex flex-col md:flex-row gap-4 mb-6 justify-between items-center bg-brand-dark/45 p-4 rounded-2xl border border-brand-border/60">
        <div class="relative w-full md:w-80">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg select-none">search</span>
            <input type="text" id="customSearchInput" placeholder="Buscar por cliente o plan..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-brand-darkest border border-brand-border text-white placeholder-slate-500 focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-xs">
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto flex-shrink-0">
            <label for="statusFilter" class="text-[10px] font-display font-black tracking-widest text-slate-400 uppercase whitespace-nowrap">Estado:</label>
            <div class="relative w-full md:w-48">
                <select id="statusFilter" class="w-full pl-4 pr-10 py-2.5 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-xs appearance-none cursor-pointer">
                    <option value="all">⚡ Todos</option>
                    <option value="active">🟢 Activas</option>
                    <option value="expired">🟠 Expiradas</option>
                    <option value="cancelled">🔴 Canceladas</option>
                </select>
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-lg select-none">expand_more</span>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="membershipsTable" class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-800">
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Cliente</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Plan</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Tipo</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Precio</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Vigencia</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Estado</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($memberships as $membership)
                <tr class="border-b border-slate-800/40 hover:bg-slate-800/30 transition-all duration-200">
                    <td class="py-4 px-6 font-display font-bold text-sm text-white">{{ $membership->client->name ?? 'N/A' }}</td>
                    <td class="py-4 px-6 text-sm text-slate-300">{{ $membership->plan_name }}</td>
                    <td class="py-4 px-6 text-sm">
                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-slate-900 border border-slate-800 text-slate-300">
                            @if($membership->plan_type === 'monthly') Mensual
                            @elseif($membership->plan_type === 'quarterly') Trimestral
                            @elseif($membership->plan_type === 'annual') Anual
                            @else Personalizado
                            @endif
                        </span>
                    </td>
                    <td class="py-4 px-6 text-sm font-bold text-emerald-400 font-display">${{ number_format($membership->price, 2) }}</td>
                    <td class="py-4 px-6 text-sm text-slate-300">
                        <div class="text-[11px]">{{ \Carbon\Carbon::parse($membership->start_date)->format('d/m/Y') }}</div>
                        <div class="text-[10px] text-slate-500">→ {{ \Carbon\Carbon::parse($membership->end_date)->format('d/m/Y') }}</div>
                    </td>
                    <td class="py-4 px-6 text-sm">
                        @if($membership->status === 'active')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-cyan-950/40 text-brand-accent border border-brand-accent/30 shadow-[0_0_10px_rgba(0,240,255,0.1)]">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-accent animate-pulse shadow-[0_0_6px_#00f0ff]"></span> Activa
                            </span>
                        @elseif($membership->status === 'expired')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-950/40 text-amber-400 border border-amber-900/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shadow-[0_0_6px_#f59e0b]"></span> Expirada
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-950/40 text-red-400 border border-red-900/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 shadow-[0_0_6px_#ef4444]"></span> Cancelada
                            </span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('memberships.edit', $membership->id) }}" class="w-9 h-9 flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-brand-accent hover:border-brand-accent hover:shadow-[0_0_10px_rgba(0,240,255,0.25)] rounded-lg transition-all duration-200" title="Editar">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('memberships.destroy', $membership->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta membresía?');" class="inline">
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
        const table = $('#membershipsTable').DataTable({
            language: { url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' },
            pageLength: 10, ordering: true, responsive: true, dom: 'tpr',
            columnDefs: [{ orderable: false, targets: [6] }]
        });
        $('#customSearchInput').on('keyup', function() { table.search(this.value).draw(); });
        $('#statusFilter').on('change', function() {
            const val = $(this).val();
            if (val === 'all') { table.column(5).search('').draw(); }
            else {
                const map = { active: 'Activa', expired: 'Expirada', cancelled: 'Cancelada' };
                table.column(5).search(map[val] || '').draw();
            }
        });
    });
</script>
@endsection