@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .neon-glow-card {
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(30, 41, 59, 0.7);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .neon-glow-card:hover {
        border-color: rgba(0, 240, 255, 0.4);
        box-shadow: 0 0 25px rgba(0, 240, 255, 0.12);
        transform: translateY(-4px);
    }
    
    .cyan-text-glow {
        text-shadow: 0 0 10px rgba(0, 240, 255, 0.5);
    }
</style>
@endsection

@section('content')
<!-- Header Section -->
<header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
    <div>
        <h2 class="font-headline text-3xl font-black text-white tracking-tight uppercase">Dashboard <span class="text-brand-accent cyan-text-glow font-headline">Performance</span></h2>
        <p class="text-sm text-slate-400 font-medium">Bienvenido de nuevo al centro de control tecnológico de NovaGym.</p>
    </div>
    <div>
        <a href="{{ route('clients.create') }}" class="bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold px-5 py-2.5 rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-105 transition-all duration-300 flex items-center gap-2 shadow-[0_0_15px_rgba(0,240,255,0.15)] text-sm">
            <span class="material-symbols-outlined text-[20px] font-black">person_add</span> Registrar Atleta
        </a>
    </div>
</header>

<!-- Metric Bento Grid -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1: Total Clients -->
    <div class="neon-glow-card p-6 rounded-2xl flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10 flex-1">
            <p class="text-[10px] text-slate-400 tracking-widest font-black uppercase font-display">Total de Clientes</p>
            <h3 class="font-headline text-4xl font-black text-white mt-2">{{ $totalClients }}</h3>
            <p class="text-[11px] text-slate-400 font-medium mt-1">Registrados en la plataforma</p>
        </div>
        <div class="w-14 h-14 rounded-xl bg-brand-accent/10 border border-brand-accent/20 flex items-center justify-center text-brand-accent shadow-[0_0_15px_rgba(0,240,255,0.1)] flex-shrink-0">
            <span class="material-symbols-outlined text-3xl font-bold">group</span>
        </div>
    </div>
    
    <!-- Card 2: Active Clients -->
    <div class="neon-glow-card p-6 rounded-2xl flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10 flex-1">
            <p class="text-[10px] text-slate-400 tracking-widest font-black uppercase font-display">Clientes Activos</p>
            <h3 class="font-headline text-4xl font-black text-emerald-400 mt-2">{{ $activeClients }}</h3>
            <p class="text-[11px] text-emerald-500/80 font-bold mt-1 flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Entrenando actualmente
            </p>
        </div>
        <div class="w-14 h-14 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shadow-[0_0_15px_rgba(16,185,129,0.1)] flex-shrink-0">
            <span class="material-symbols-outlined text-3xl font-bold">how_to_reg</span>
        </div>
    </div>
    
    <!-- Card 3: Inactive Clients -->
    <div class="neon-glow-card p-6 rounded-2xl flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10 flex-1">
            <p class="text-[10px] text-slate-400 tracking-widest font-black uppercase font-display">Clientes Inactivos</p>
            <h3 class="font-headline text-4xl font-black text-red-400 mt-2">{{ $inactiveClients }}</h3>
            <p class="text-[11px] text-red-400 font-semibold mt-1">Requieren seguimiento o pausa</p>
        </div>
        <div class="w-14 h-14 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400 shadow-[0_0_15px_rgba(239,68,68,0.1)] flex-shrink-0">
            <span class="material-symbols-outlined text-3xl font-bold">person_off</span>
        </div>
    </div>
    
    <!-- Card 4: Routines Total -->
    <div class="neon-glow-card p-6 rounded-2xl flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10 flex-1">
            <p class="text-[10px] text-slate-400 tracking-widest font-black uppercase font-display">Rutinas Asignadas</p>
            <h3 class="font-headline text-4xl font-black text-amber-400 mt-2">{{ $totalRoutines }}</h3>
            <p class="text-[11px] text-slate-400 font-medium mt-1">Planes activos de atletas</p>
        </div>
        <div class="w-14 h-14 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 shadow-[0_0_15px_rgba(245,158,11,0.1)] flex-shrink-0">
            <span class="material-symbols-outlined text-3xl font-bold">fitness_center</span>
        </div>
    </div>
</section>

<!-- Dashboard Main Layout Grid -->
<section class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
    
    <!-- Chart Container (2 Cols) -->
    <div class="lg:col-span-2 neon-glow-card p-6 rounded-2xl bg-brand-dark/45">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h4 class="font-display font-bold text-white text-lg flex items-center gap-2">
                    <span class="material-symbols-outlined text-brand-accent">monitoring</span> Registro Histórico de Socios
                </h4>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Evolución mensual de registros y altas de atletas.</p>
            </div>
            <div class="flex gap-2">
                <button id="btnMensual" class="text-xs px-3 py-1.5 rounded-lg bg-brand-accent/20 border border-brand-accent/30 text-brand-accent font-bold font-display shadow-lg shadow-brand-accent/10 transition-all">Mensual</button>
                <button id="btnAnual" class="text-xs px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-800 text-slate-400 font-bold font-display hover:text-white transition-all">Anual</button>
            </div>
        </div>
        
        <div class="h-[400px] w-full relative">
            <canvas id="clientsChart"></canvas>
        </div>
    </div>
    
    <!-- Right Sidebar Bento (1 Col) -->
    <div class="space-y-6">
        
        <!-- Recent Activity Logs -->
        <div class="neon-glow-card p-6 rounded-2xl bg-brand-dark/45">
            <h4 class="font-display font-bold text-white text-lg mb-4 flex items-center gap-2 border-b border-slate-800 pb-3">
                <span class="material-symbols-outlined text-brand-accent">explore</span> Actividad Reciente
            </h4>
            <div class="space-y-4">
                @foreach($recentActivities as $activity)
                <div class="flex items-start gap-3 py-1.5 group">
                    <div class="w-8 h-8 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-brand-accent shadow-lg flex-shrink-0 group-hover:border-brand-accent/50 transition-colors">
                        <span class="material-symbols-outlined text-[16px]">{{ $activity['icon'] }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-slate-200 group-hover:text-white transition-colors truncate">{{ $activity['title'] }}</p>
                        <p class="text-[11px] text-slate-400 mt-0.5 leading-snug">{{ $activity['description'] }}</p>
                        <p class="text-[10px] text-brand-accent font-bold tracking-wide mt-1.5 flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-brand-accent"></span> {{ $activity['time'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Futuristic AI Optimizer Module -->
        <div class="bg-gradient-to-br from-slate-950 via-[#0a1120] to-[#030712] border-2 border-brand-accent/20 rounded-2xl p-6 flex flex-col justify-between h-[210px] relative overflow-hidden group shadow-2xl">
            <div class="absolute inset-0 bg-cyan-500/5 mix-blend-overlay pointer-events-none"></div>
            <!-- Glow background decor -->
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-brand-accent/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-1.5 mb-2">
                    <span class="w-2 h-2 rounded-full bg-brand-accent animate-pulse"></span>
                    <p class="text-brand-accent font-display text-[10px] font-black uppercase tracking-widest">NovaGym AI Optimizer</p>
                </div>
                <h5 class="text-white text-lg font-display font-black leading-tight tracking-tight mt-1">Optimiza el impacto de tus rutinas con Inteligencia Artificial.</h5>
                <p class="text-[11px] text-slate-400 mt-2 font-medium">Analiza fatiga, cargas y progresión muscular de atletas.</p>
            </div>
            
            <button onclick="alert('Se está inicializando el servicio NovaGym AI Optimizer...')" class="relative z-10 bg-brand-accent text-brand-darkest font-display font-bold text-xs py-2.5 px-5 rounded-xl self-start mt-4 hover:scale-95 transition-transform duration-150 shadow-[0_0_20px_rgba(0,240,255,0.35)]">
                Analizar Ahora
            </button>
        </div>
        
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('clientsChart').getContext('2d');
        
        // PHP variables injection
        const monthlyLabels = @json($months);
        const monthlyData = @json($counts);
        const annualLabels = @json($years);
        const annualData = @json($yearCounts);

        // Cyber cian to electric blue gradient matching
        const gradient = ctx.createLinearGradient(0, 0, 0, 360);
        gradient.addColorStop(0, 'rgba(0, 240, 255, 0.4)');
        gradient.addColorStop(0.5, 'rgba(37, 99, 235, 0.15)');
        gradient.addColorStop(1, 'rgba(3, 7, 18, 0)');

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Registros Nuevos',
                    data: monthlyData,
                    borderColor: '#00f0ff',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3.5,
                    pointRadius: 6,
                    pointBackgroundColor: '#00f0ff',
                    pointBorderColor: '#030712',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#00f0ff',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#ffffff',
                        bodyColor: '#00f0ff',
                        titleFont: { family: 'Space Grotesk', size: 12, weight: 'bold' },
                        bodyFont: { family: 'Inter', size: 12, weight: 'bold' },
                        borderColor: '#1e293b',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        cornerRadius: 10,
                        callbacks: {
                            label: function(context) {
                                return `+${context.raw} Atletas`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 5,
                        grid: {
                            color: 'rgba(30, 41, 59, 0.3)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: { family: 'Inter', size: 11, weight: '500' },
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: { family: 'Inter', size: 11, weight: '500' }
                        }
                    }
                }
            }
        });

        // Switcher Buttons logic
        const btnMensual = document.getElementById('btnMensual');
        const btnAnual = document.getElementById('btnAnual');

        btnMensual.addEventListener('click', function() {
            // Update button styles
            btnMensual.className = "text-xs px-3 py-1.5 rounded-lg bg-brand-accent/20 border border-brand-accent/30 text-brand-accent font-bold font-display shadow-lg shadow-brand-accent/10 transition-all";
            btnAnual.className = "text-xs px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-800 text-slate-400 font-bold font-display hover:text-white transition-all";
            
            // Update chart data
            chart.data.labels = monthlyLabels;
            chart.data.datasets[0].data = monthlyData;
            
            // Set monthly y-scale limits: min 0, max 5 (as requested)
            chart.options.scales.y.min = 0;
            chart.options.scales.y.max = 5;
            chart.options.scales.y.ticks.stepSize = 1;
            
            chart.update();
        });

        btnAnual.addEventListener('click', function() {
            // Update button styles
            btnAnual.className = "text-xs px-3 py-1.5 rounded-lg bg-brand-accent/20 border border-brand-accent/30 text-brand-accent font-bold font-display shadow-lg shadow-brand-accent/10 transition-all";
            btnMensual.className = "text-xs px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-800 text-slate-400 font-bold font-display hover:text-white transition-all";
            
            // Update chart data
            chart.data.labels = annualLabels;
            chart.data.datasets[0].data = annualData;
            
            // Set annual y-scale limits: min 0, max 15 (since max data is 11)
            chart.options.scales.y.min = 0;
            chart.options.scales.y.max = 15;
            chart.options.scales.y.ticks.stepSize = 3;
            
            chart.update();
        });
    });
</script>
@endsection
