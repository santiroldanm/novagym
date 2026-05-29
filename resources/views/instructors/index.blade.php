@extends('layouts.app')

@section('title', 'Instructores')

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
        <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Gestión de <span class="text-brand-accent cyan-glow-text font-headline">Instructores</span></h2>
        <p class="text-sm text-slate-400 font-medium">Administra el cuerpo de entrenadores y especialistas del gimnasio.</p>
    </div>
    <div>
        <a href="{{ route('instructors.create') }}" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold px-5 py-2.5 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 flex items-center gap-2 shadow-[0_0_15px_rgba(0,240,255,0.15)] text-sm">
            <span class="material-symbols-outlined text-[20px] font-black">person_add</span> Registrar Instructor
        </a>
    </div>
</header>

<section class="neon-card p-6 rounded-2xl">
    <div class="flex flex-col md:flex-row gap-4 mb-6 justify-between items-center bg-brand-dark/45 p-4 rounded-2xl border border-brand-border/60">
        <div class="relative w-full md:w-80">
            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg select-none">search</span>
            <input type="text" id="customSearchInput" placeholder="Buscar instructores por nombre o especialidad..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-brand-darkest border border-brand-border text-white placeholder-slate-500 focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-xs">
        </div>
        
        <div class="flex items-center gap-3 w-full md:w-auto flex-shrink-0">
            <label for="statusFilter" class="text-[10px] font-display font-black tracking-widest text-slate-400 uppercase whitespace-nowrap">Estado:</label>
            <div class="relative w-full md:w-48">
                <select id="statusFilter" class="w-full pl-4 pr-10 py-2.5 rounded-xl bg-brand-darkest border border-brand-border text-white focus:outline-none focus:border-brand-accent focus:shadow-[0_0_15px_rgba(0,240,255,0.2)] transition-all duration-300 text-xs appearance-none cursor-pointer">
                    <option value="all">⚡ Todos los estados</option>
                    <option value="active">🟢 Activos</option>
                    <option value="inactive">🔴 Inactivos</option>
                </select>
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-lg select-none">expand_more</span>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="instructorsTable" class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-800">
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Foto</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Nombre</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Contacto</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Especialidad</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display">Estado</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display text-center">Membresías</th>
                    <th class="py-4 px-6 text-[11px] font-black tracking-widest text-brand-accent uppercase font-display text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($instructors as $instructor)
                <tr class="border-b border-slate-800/40 hover:bg-slate-800/30 transition-all duration-200 {{ $instructor->status === 'inactive' ? 'bg-red-500/5 hover:bg-red-500/10 border-red-500/10' : '' }}">
                    <td class="py-4 px-6">
                        <div class="w-11 h-11 rounded-full overflow-hidden border-2 border-slate-800 flex items-center justify-center bg-slate-950/60 shadow-[0_0_10px_rgba(0,0,0,0.5)]">
                            @if($instructor->photo)
                                <img src="{{ asset('storage/' . $instructor->photo) }}" alt="{{ $instructor->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-slate-600 text-2xl font-bold select-none">account_circle</span>
                            @endif
                        </div>
                    </td>
                    
                    <td class="py-4 px-6 font-display font-bold text-sm text-white">
                        {{ $instructor->name }}
                    </td>
                    
                    <td class="py-4 px-6 text-sm">
                        <div class="text-slate-200 font-medium">{{ $instructor->email }}</div>
                        <div class="text-[11px] text-slate-500 font-semibold mt-1 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[12px] text-brand-accent">phone</span>
                            <span>{{ $instructor->phone ?? 'Sin teléfono' }}</span>
                        </div>
                    </td>
                    
                    <td class="py-4 px-6 text-sm text-slate-300">
                        {{ $instructor->specialty ?? 'General' }}
                    </td>
                    
                    <td class="py-4 px-6 text-sm">
                        @if($instructor->status === 'active')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-cyan-950/40 text-brand-accent border border-brand-accent/30 shadow-[0_0_10px_rgba(0,240,255,0.1)]">
                                <span class="w-1.5 h-1.5 rounded-full bg-brand-accent animate-pulse shadow-[0_0_6px_#00f0ff]"></span> Activo
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-950/40 text-red-400 border border-red-900/30">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 shadow-[0_0_6px_#ef4444]"></span> Inactivo
                            </span>
                        @endif
                    </td>
                    
                    <td class="py-4 px-6 text-center text-sm font-black text-brand-accent font-display">
                        {{ $instructor->memberships_count }}
                    </td>
                    
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('instructors.edit', $instructor->id) }}" class="w-9 h-9 flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-brand-accent hover:border-brand-accent hover:shadow-[0_0_10px_rgba(0,240,255,0.25)] rounded-lg transition-all duration-200" title="Editar Instructor">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            
                            <form action="{{ route('instructors.destroy', $instructor->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a {{ $instructor->name }}?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-red-400 hover:border-red-500/50 hover:shadow-[0_0_10px_rgba(239,68,68,0.25)] rounded-lg transition-all duration-200" title="Eliminar Instructor">
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
        const table = $('#instructorsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json'
            },
            pageLength: 10,
            ordering: true,
            responsive: true,
            dom: 'tpr',
            columnDefs: [
                { orderable: false, targets: [0, 6] }
            ]
        });

        $('#customSearchInput').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#statusFilter').on('change', function() {
            const val = $(this).val();
            if (val === 'all') {
                table.column(4).search('').draw();
            } else {
                const searchStr = val === 'active' ? 'Activo' : 'Inactivo';
                table.column(4).search(searchStr).draw();
            }
        });
    });
</script>
@endsection