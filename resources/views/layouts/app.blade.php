<!DOCTYPE html>
<html class="dark scroll-smooth" lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NovaGym') - High Performance System</title>
    
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@600;700;800;900&family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        brand: {
                            darkest: "#030712", // slate-950
                            dark: "#0b0f19",    // slate-900
                            card: "#0f172a",    // slate-900 card
                            border: "#1e293b",  // slate-800
                            accent: "#00f0ff",   // Cyber cian
                            accentDim: "rgba(0, 240, 255, 0.12)",
                            accentMuted: "rgba(0, 240, 255, 0.04)"
                        }
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                        display: ["Space Grotesk", "sans-serif"],
                        headline: ["Hanken Grotesk", "sans-serif"]
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #030712; /* Slate-950 background */
            color: #f1f5f9; /* Slate-100 */
            font-family: 'Inter', sans-serif;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #030712;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #00f0ff;
        }

        /* High-tech glow states */
        .neon-border-glow {
            transition: all 0.3s ease;
        }
        .neon-border-glow:hover {
            box-shadow: 0 0 20px rgba(0, 240, 255, 0.2);
            border-color: rgba(0, 240, 255, 0.6);
        }
        
        .neon-text-glow {
            text-shadow: 0 0 12px rgba(0, 240, 255, 0.6);
        }

        /* Sidebar Item Active */
        .sidebar-active {
            background: linear-gradient(90deg, rgba(0, 240, 255, 0.12) 0%, rgba(0, 240, 255, 0.02) 100%);
            color: #00f0ff;
            border-left: 4px solid #00f0ff;
            font-weight: 700;
            box-shadow: inset 1px 0 0 rgba(0, 240, 255, 0.1);
        }

        /* Customize DataTables layout to match beautiful Obsidian Slate style */
        .dataTables_wrapper .dataTables_length, 
        .dataTables_wrapper .dataTables_filter, 
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: #94a3b8 !important; /* slate-400 */
            font-size: 0.85rem;
            margin-bottom: 16px;
        }
        
        .dataTables_wrapper .dataTables_filter input {
            background-color: #0b0f19 !important;
            border: 1px solid #1e293b !important;
            color: #ffffff !important;
            border-radius: 10px !important;
            padding: 8px 14px !important;
            outline: none;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #00f0ff !important;
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.25) !important;
        }

        .dataTables_wrapper .dataTables_length select {
            background-color: #0b0f19 !important;
            border: 1px solid #1e293b !important;
            color: #ffffff !important;
            border-radius: 10px !important;
            padding: 6px 30px 6px 12px !important;
            outline: none;
        }

        table.dataTable {
            border-collapse: collapse !important;
            background-color: #0b0f19 !important;
            border-radius: 16px !important;
            overflow: hidden;
            border: 1px solid #1e293b !important;
            margin-top: 20px !important;
            margin-bottom: 20px !important;
        }

        table.dataTable thead th {
            background-color: #0f172a !important;
            border-bottom: 1px solid #1e293b !important;
            color: #00f0ff !important;
            font-family: 'Space Grotesk', sans-serif !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.07em;
            padding: 18px 24px !important;
        }

        table.dataTable tbody tr {
            background-color: #0b0f19 !important;
            border-bottom: 1px solid #1e293b/40 !important;
            transition: all 0.2s ease;
        }

        table.dataTable tbody tr:last-child {
            border-bottom: none !important;
        }

        table.dataTable tbody tr:hover {
            background-color: rgba(30, 41, 59, 0.4) !important; /* hover:bg-slate-800/40 */
        }

        table.dataTable tbody td {
            padding: 16px 24px !important;
            color: #e2e8f0;
            font-size: 0.875rem;
            border-top: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #94a3b8 !important;
            border: 1px solid transparent !important;
            border-radius: 10px !important;
            padding: 6px 14px !important;
            transition: all 0.25s ease;
            margin-left: 4px;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(0, 240, 255, 0.12) !important;
            color: #00f0ff !important;
            border-color: rgba(0, 240, 255, 0.25) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, #00f0ff 0%, #0891b2 100%) !important;
            color: #030712 !important;
            border: 1px solid #00f0ff !important;
            font-weight: 700;
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.3) !important;
        }

        /* Sidebar collapse transition styling */
        aside, main {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        
        .sidebar-collapsed aside {
            width: 80px !important;
            padding-left: 12px !important;
            padding-right: 12px !important;
        }
        
        .sidebar-collapsed main {
            margin-left: 80px !important;
        }
        
        .sidebar-collapsed .hide-collapsed {
            opacity: 0 !important;
            width: 0 !important;
            max-width: 0 !important;
            overflow: hidden !important;
            pointer-events: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .sidebar-collapsed .center-collapsed {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        
        .sidebar-collapsed .px-4 {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
        
        /* Rotate chevron icon when collapsed */
        .sidebar-collapsed #sidebar-toggle-btn span {
            transform: rotate(180deg);
        }
    </style>
    @yield('styles')
</head>
<body class="bg-brand-darkest min-h-screen text-slate-100 antialiased selection:bg-brand-accent/30 selection:text-brand-accent">

    
    <div id="app-wrapper" class="flex min-h-screen relative overflow-hidden">
        
        <div class="absolute w-[600px] h-[600px] rounded-full bg-cyan-500/5 blur-[120px] top-[-200px] left-[-200px] pointer-events-none"></div>
        <div class="absolute w-[600px] h-[600px] rounded-full bg-blue-600/5 blur-[120px] bottom-[-200px] right-[-200px] pointer-events-none"></div>
        
        
        <aside id="sidebar" class="fixed left-0 top-0 h-full w-[260px] bg-brand-dark/95 border-r border-brand-border/60 flex flex-col justify-between py-8 px-6 z-50 backdrop-blur-md shadow-2xl">
            
            <button id="sidebar-toggle-btn" class="absolute -right-3.5 top-8 w-7 h-7 rounded-full bg-brand-dark border border-brand-border hover:border-brand-accent text-slate-400 hover:text-brand-accent flex items-center justify-center transition-all duration-300 shadow-md shadow-black/80 hover:shadow-[0_0_10px_rgba(0,240,255,0.4)] z-[60]">
                <span class="material-symbols-outlined text-[16px] font-black select-none transition-transform duration-300">chevron_left</span>
            </button>

            
            <div class="flex flex-col flex-1">
                
                <div class="px-2 mb-10 flex items-center gap-3 transition-all duration-300 center-collapsed">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-accent to-cyan-700 flex items-center justify-center shadow-lg shadow-brand-accent/25 ring-1 ring-brand-accent/30 flex-shrink-0">
                        <span class="material-symbols-outlined text-brand-darkest text-2xl font-black">bolt</span>
                    </div>
                    <div class="hide-collapsed transition-all duration-300 whitespace-nowrap">
                        <h1 class="text-2xl font-display font-black text-white tracking-tight leading-none">NOVA<span class="text-brand-accent neon-text-glow font-display">GYM</span></h1>
                        <p class="text-[9px] font-bold text-brand-accent tracking-widest uppercase mt-1 font-display">Power & Performance</p>
                    </div>
                </div>
                
                
                @auth
                <div class="mb-8 px-3 py-3 rounded-2xl bg-brand-card/60 border border-brand-border/50 shadow-lg flex items-center gap-3 group relative overflow-hidden transition-all duration-300 center-collapsed">
                    
                    <div class="absolute inset-0 bg-gradient-to-tr from-brand-accent/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    
                    <div class="w-11 h-11 rounded-full overflow-hidden border-2 border-brand-accent flex-shrink-0 bg-brand-dark flex items-center justify-center shadow-[0_0_12px_rgba(0,240,255,0.25)] group-hover:scale-105 transition-transform duration-300 relative">
                        <span class="material-symbols-outlined text-brand-accent text-2xl font-bold select-none">account_circle</span>
                    </div>
                    
                    <div class="hide-collapsed transition-all duration-300 whitespace-nowrap overflow-hidden relative z-10">
                        <p class="text-sm font-semibold font-display text-white truncate leading-tight tracking-wide">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-slate-400 tracking-wider font-semibold mt-1 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_#10b981]"></span>
                            <span class="uppercase text-[9px] text-emerald-400 tracking-widest font-display">Administrador</span>
                        </p>
                    </div>
                </div>
                @endauth
                
                
                <nav class="space-y-1.5">
                    <a class="{{ Request::routeIs('dashboard') ? 'sidebar-active text-brand-accent' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-900/60 hover:border-l-4 hover:border-brand-accent/40' }} flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-300 group center-collapsed" href="{{ route('dashboard') }}">
                        <span class="material-symbols-outlined text-[22px] transition-transform group-hover:scale-110 flex-shrink-0">grid_view</span>
                        <span class="font-display font-bold text-sm tracking-wide hide-collapsed whitespace-nowrap transition-all duration-300">Inicio</span>
                    </a>
                    
                    <a class="{{ Request::routeIs('clients.*') ? 'sidebar-active text-brand-accent' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-900/60 hover:border-l-4 hover:border-brand-accent/40' }} flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-300 group center-collapsed" href="{{ route('clients.index') }}">
                        <span class="material-symbols-outlined text-[22px] transition-transform group-hover:scale-110 flex-shrink-0">group</span>
                        <span class="font-display font-bold text-sm tracking-wide hide-collapsed whitespace-nowrap transition-all duration-300">Clientes</span>
                    </a>
                    
                    <a class="{{ Request::routeIs('routines.*') ? 'sidebar-active text-brand-accent' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-900/60 hover:border-l-4 hover:border-brand-accent/40' }} flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-300 group center-collapsed" href="{{ route('routines.index') }}">
                        <span class="material-symbols-outlined text-[22px] transition-transform group-hover:scale-110 flex-shrink-0">fitness_center</span>
                        <span class="font-display font-bold text-sm tracking-wide hide-collapsed whitespace-nowrap transition-all duration-300">Rutinas</span>
                    </a>
                    
                    <a class="{{ Request::routeIs('instructors.*') ? 'sidebar-active text-brand-accent' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-900/60 hover:border-l-4 hover:border-brand-accent/40' }} flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-300 group center-collapsed" href="{{ route('instructors.index') }}">
                        <span class="material-symbols-outlined text-[22px] transition-transform group-hover:scale-110 flex-shrink-0">sports</span>
                        <span class="font-display font-bold text-sm tracking-wide hide-collapsed whitespace-nowrap transition-all duration-300">Instructores</span>
                    </a>
                    
                    <a class="{{ Request::routeIs('memberships.*') ? 'sidebar-active text-brand-accent' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-900/60 hover:border-l-4 hover:border-brand-accent/40' }} flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-300 group center-collapsed" href="{{ route('memberships.index') }}">
                        <span class="material-symbols-outlined text-[22px] transition-transform group-hover:scale-110 flex-shrink-0">credit_card</span>
                        <span class="font-display font-bold text-sm tracking-wide hide-collapsed whitespace-nowrap transition-all duration-300">Membresías</span>
                    </a>
                    
                    <a class="{{ Request::routeIs('meal-plans.*') ? 'sidebar-active text-brand-accent' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-900/60 hover:border-l-4 hover:border-brand-accent/40' }} flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-300 group center-collapsed" href="{{ route('meal-plans.index') }}">
                        <span class="material-symbols-outlined text-[22px] transition-transform group-hover:scale-110 flex-shrink-0">restaurant</span>
                        <span class="font-display font-bold text-sm tracking-wide hide-collapsed whitespace-nowrap transition-all duration-300">Nutrición</span>
                    </a>
                    
                    <a class="{{ Request::routeIs('branches.*') ? 'sidebar-active text-brand-accent' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-900/60 hover:border-l-4 hover:border-brand-accent/40' }} flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-300 group center-collapsed" href="{{ route('branches.index') }}">
                        <span class="material-symbols-outlined text-[22px] transition-transform group-hover:scale-110 flex-shrink-0">domain</span>
                        <span class="font-display font-bold text-sm tracking-wide hide-collapsed whitespace-nowrap transition-all duration-300">Sedes</span>
                    </a>
                    
                    <a class="{{ Request::routeIs('profile.edit') ? 'sidebar-active text-brand-accent' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-900/60 hover:border-l-4 hover:border-brand-accent/40' }} flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-300 group center-collapsed" href="{{ route('profile.edit') }}">
                        <span class="material-symbols-outlined text-[22px] transition-transform group-hover:scale-110 flex-shrink-0">manage_accounts</span>
                        <span class="font-display font-bold text-sm tracking-wide hide-collapsed whitespace-nowrap transition-all duration-300">Mi Perfil</span>
                    </a>
                </nav>
            </div>
            
            
            @auth
            <div class="border-t border-brand-border/40 pt-4 mt-auto">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <button type="submit" class="w-full text-slate-400 hover:bg-red-950/20 hover:text-red-400 flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-300 group border border-transparent hover:border-red-950/40 center-collapsed">
                        <span class="material-symbols-outlined text-[22px] text-slate-400 group-hover:text-red-400 group-hover:rotate-90 transition-all duration-300 flex-shrink-0">logout</span>
                        <span class="font-display font-bold text-sm tracking-wide hide-collapsed whitespace-nowrap transition-all duration-300">Cerrar Sesión</span>
                    </button>
                </form>
            </div>
            @endauth
        </aside>

        
        <main class="ml-[260px] flex-1 min-h-screen flex flex-col relative z-10">
            
            
            @if(session('success'))
            <div class="sys-notification fixed top-6 right-6 z-[100] animate-bounce max-w-sm">
                <div class="bg-slate-900 border-2 border-brand-accent/50 text-white px-5 py-4 rounded-2xl shadow-[0_0_30px_rgba(0,240,255,0.25)] flex items-center gap-3 backdrop-blur-md">
                    <div class="w-8 h-8 rounded-lg bg-brand-accentDim flex items-center justify-center">
                        <span class="material-symbols-outlined text-brand-accent text-xl">check_circle</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-brand-accent tracking-widest uppercase font-display">Operación Exitosa</p>
                        <p class="text-sm font-semibold text-slate-200 leading-tight mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            
            @if($errors->any() && !Request::routeIs('login') && !Request::routeIs('register'))
            <div class="sys-notification fixed top-6 right-6 z-[100] max-w-sm animate-pulse">
                <div class="bg-slate-900 border-2 border-red-500/50 text-white px-5 py-4 rounded-2xl shadow-[0_0_30px_rgba(239,68,68,0.25)] backdrop-blur-md">
                    <div class="flex items-center gap-3 mb-3 text-red-400 font-bold text-sm font-display">
                        <span class="material-symbols-outlined">error</span>
                        <span>Corregir Anomalías</span>
                    </div>
                    <ul class="list-disc pl-5 text-xs space-y-1.5 text-slate-300">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            
            <div class="flex-1 p-8 max-w-[1600px] w-full mx-auto">
                @yield('content')
            </div>

            
            <footer class="bg-brand-darkest border-t border-brand-border/40 px-8 py-6 flex flex-col md:flex-row justify-between items-center text-[11px] text-slate-500">
                <p class="font-display font-medium">© 2026 NOVA<span class="text-brand-accent font-display">GYM</span> Systems. Designed for high performance coaching.</p>
                <div class="flex gap-4 mt-2 md:mt-0 font-display font-bold">
                    <a class="hover:text-brand-accent transition-colors" href="#">SOPORTE TÉCNICO</a>
                    <span class="text-brand-border select-none">|</span>
                    <a class="hover:text-brand-accent transition-colors" href="#">TÉRMINOS OPERACIONALES</a>
                </div>
            </footer>
        </main>
    </div>

    
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script>
        // Automatic alert notification fadeout
        setTimeout(() => {
            $('.sys-notification').fadeOut(600);
        }, 5000);

        // --- Sidebar Premium Interaction Script ---
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('app-wrapper');
            const toggleBtn = document.getElementById('sidebar-toggle-btn');
            
            // Check previous user setting or default to expanded
            let isManualCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            
            if (isManualCollapsed) {
                wrapper.classList.add('sidebar-collapsed');
            }

            // Function to update state and save preference
            function setCollapsedState(state) {
                if (state) {
                    wrapper.classList.add('sidebar-collapsed');
                } else {
                    wrapper.classList.remove('sidebar-collapsed');
                }
            }

            // Manual toggle button action
            toggleBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                isManualCollapsed = !isManualCollapsed;
                localStorage.setItem('sidebarCollapsed', isManualCollapsed);
                setCollapsedState(isManualCollapsed);
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
