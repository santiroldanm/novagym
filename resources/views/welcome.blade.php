<!DOCTYPE html>
<html class="dark scroll-smooth" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>NovaGym - Entrena en el Futuro</title>


    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@700;800;900&family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

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
                            accent: "#00f0ff",   // Cyber cian
                            accentDim: "rgba(0, 240, 255, 0.12)",
                            border: "#1e293b"   // slate-800
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
            background-color: #030712;
            color: #f1f5f9;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

        .neon-card {
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(30, 41, 59, 0.7);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .neon-card:hover {
            border-color: rgba(0, 240, 255, 0.4);
            box-shadow: 0 0 25px rgba(0, 240, 255, 0.15);
            transform: translateY(-5px);
        }

        .text-glow {
            text-shadow: 0 0 12px rgba(0, 240, 255, 0.6);
        }

        /* Tech Grid Mesh Background */
        .tech-grid-mesh {
            background-size: 40px 40px;
            background-image:
                linear-gradient(to right, rgba(30, 41, 59, 0.2) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(30, 41, 59, 0.2) 1px, transparent 1px);
        }
    </style>
</head>

<body class="bg-brand-darkest selection:bg-brand-accent/30 selection:text-brand-accent antialiased relative">

    <div
        class="absolute w-[800px] h-[800px] rounded-full bg-cyan-500/5 blur-[150px] top-[-100px] right-[-100px] pointer-events-none z-0">
    </div>
    <div
        class="absolute w-[800px] h-[800px] rounded-full bg-blue-600/5 blur-[150px] bottom-[200px] left-[-200px] pointer-events-none z-0">
    </div>

    <div class="tech-grid-mesh absolute inset-0 opacity-40 pointer-events-none z-0"></div>


    <nav class="fixed top-0 left-0 w-full z-50 bg-brand-darkest/80 backdrop-blur-md border-b border-brand-border/40">
        <div class="flex justify-between items-center px-8 py-4 w-full max-w-7xl mx-auto">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-brand-accent text-[28px] font-black text-glow">bolt</span>
                <span class="text-2xl font-display font-black text-white tracking-tight uppercase">NOVA<span
                        class="text-brand-accent text-glow">GYM</span></span>
            </div>

            <div class="hidden md:flex items-center gap-8">
                <a class="font-display font-bold text-sm text-brand-accent tracking-wide" href="#">INICIO</a>
                <a class="font-display font-bold text-sm text-slate-400 hover:text-white tracking-wide transition-colors"
                    href="#servicios">MÓDULOS</a>
                <a class="font-display font-bold text-sm text-slate-400 hover:text-white tracking-wide transition-colors"
                    href="#comenzar">COMENZAR AHORA</a>
            </div>

            <div>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-6 py-2.5 bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold rounded-xl hover:scale-95 transition-all duration-200 inline-block shadow-[0_0_20px_rgba(0,240,255,0.3)] text-sm">
                        Panel de Control
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2.5 bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold rounded-xl hover:scale-95 transition-all duration-200 inline-block shadow-[0_0_20px_rgba(0,240,255,0.3)] text-sm">
                        Acceder al Sistema
                    </a>
                @endauth
            </div>
        </div>
    </nav>


    <main class="relative pt-24 z-10">


        <section class="relative px-8 py-16 max-w-7xl mx-auto min-h-[680px] flex items-center">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center w-full">


                <div class="lg:col-span-7 space-y-6">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-1.5 bg-brand-accent/10 border border-brand-accent/20 rounded-full">
                        <span
                            class="material-symbols-outlined text-[16px] text-brand-accent font-black animate-pulse">bolt</span>
                        <span
                            class="font-display text-[10px] font-black uppercase text-brand-accent tracking-widest">SISTEMA
                            DE ALTO RENDIMIENTO</span>
                    </div>

                    <h1
                        class="font-display text-5xl lg:text-7xl font-black text-white leading-none uppercase tracking-tight">
                        Entrena en el <span class="text-brand-accent text-glow font-display">Futuro</span>
                    </h1>

                    <p class="text-base text-slate-400 leading-relaxed max-w-xl font-medium">
                        Gestión inteligente, planificaciones técnicas y analítica de datos para centros de fitness de
                        alto rendimiento. Optimiza tu operativa, automatiza entrenamientos y lidera la industria
                        tecnológica del deporte.
                    </p>

                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="{{ route('register') }}"
                            class="px-8 py-3.5 bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold rounded-xl shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:brightness-110 hover:scale-105 transition-all duration-200 text-sm">
                            Registrarse Gratis
                        </a>
                        <a href="#servicios"
                            class="px-8 py-3.5 border border-slate-800 text-white font-display font-bold rounded-xl hover:bg-slate-900 transition-all text-sm">
                            Descubrir Módulos
                        </a>
                    </div>
                </div>


                <div class="lg:col-span-5 relative">
                    <div
                        class="relative rounded-2xl overflow-hidden neon-card p-2 aspect-square flex items-center justify-center shadow-2xl">

                        <img alt="NovaGym Athletical Performance"
                            class="w-full h-full object-cover rounded-xl grayscale hover:grayscale-0 transition-all duration-700"
                            src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?auto=format&fit=crop&q=80&w=800" />


                        <div
                            class="absolute bottom-6 left-6 right-6 p-5 rounded-xl bg-brand-dark/85 border border-brand-accent/25 backdrop-blur-md shadow-2xl">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p
                                        class="font-display text-[9px] font-black text-brand-accent uppercase tracking-widest">
                                        Retención Atletas</p>
                                    <p class="font-display text-2xl font-black text-white uppercase mt-0.5">98% EFICACIA
                                    </p>
                                </div>
                                <span
                                    class="material-symbols-outlined text-brand-accent text-[36px] font-bold">trending_up</span>
                            </div>
                        </div>
                    </div>


                    <div class="absolute -top-6 -right-6 w-36 h-36 bg-brand-accent/15 blur-3xl rounded-full"></div>
                </div>
            </div>
        </section>


        <section id="servicios" class="px-8 py-24 max-w-7xl mx-auto">
            <div class="text-center mb-16 space-y-3">
                <h2 class="font-display text-4xl font-black text-white uppercase tracking-tight">POTENCIA TU <span
                        class="text-brand-accent font-display cyan-glow-text">GIMNASIO</span></h2>
                <p class="text-sm text-slate-400 max-w-2xl mx-auto font-medium">
                    Módulos avanzados diseñados específicamente para la precisión técnica, fidelización y el crecimiento
                    integral de atletas y negocios.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">


                <div class="neon-card p-8 rounded-2xl group flex flex-col justify-between">
                    <div>
                        <div
                            class="w-12 h-12 rounded-xl bg-brand-accent/10 flex items-center justify-center mb-6 border border-brand-accent/20 group-hover:border-brand-accent/50 transition-colors shadow-lg shadow-brand-accent/5">
                            <span class="material-symbols-outlined text-brand-accent text-2xl font-black">group</span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-white mb-3">Gestión de Socios</h3>
                        <p class="text-slate-400 text-sm leading-relaxed mb-6 font-medium">
                            Control absoluto del registro de clientes. Organiza datos, estados de membresías y realiza
                            auditorías operativas ágiles de manera simplificada.
                        </p>
                    </div>
                    <ul class="space-y-2.5 border-t border-slate-800/80 pt-4">
                        <li class="flex items-center gap-2 text-xs font-bold text-slate-300">
                            <span class="material-symbols-outlined text-brand-accent text-lg">check_circle</span>
                            Membresías Activas / Inactivas
                        </li>
                        <li class="flex items-center gap-2 text-xs font-bold text-slate-300">
                            <span class="material-symbols-outlined text-brand-accent text-lg">check_circle</span>
                            Filtros interactivos con DataTables
                        </li>
                    </ul>
                </div>


                <div class="neon-card p-8 rounded-2xl group flex flex-col justify-between">
                    <div>
                        <div
                            class="w-12 h-12 rounded-xl bg-brand-accent/10 flex items-center justify-center mb-6 border border-brand-accent/20 group-hover:border-brand-accent/50 transition-colors shadow-lg shadow-brand-accent/5">
                            <span
                                class="material-symbols-outlined text-brand-accent text-2xl font-black">fitness_center</span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-white mb-3">Planificación de Rutinas</h3>
                        <p class="text-slate-400 text-sm leading-relaxed mb-6 font-medium">
                            Diseño estructurado de planes de entrenamiento de alta intensidad con niveles de dificultad
                            y descripciones anatómicas minuciosamente detalladas.
                        </p>
                    </div>
                    <ul class="space-y-2.5 border-t border-slate-800/80 pt-4">
                        <li class="flex items-center gap-2 text-xs font-bold text-slate-300">
                            <span class="material-symbols-outlined text-brand-accent text-lg">check_circle</span>
                            Categorías por dificultad deportiva
                        </li>
                        <li class="flex items-center gap-2 text-xs font-bold text-slate-300">
                            <span class="material-symbols-outlined text-brand-accent text-lg">check_circle</span>
                            Borrado en cascada automatizado
                        </li>
                    </ul>
                </div>


                <div class="neon-card p-8 rounded-2xl group flex flex-col justify-between">
                    <div>
                        <div
                            class="w-12 h-12 rounded-xl bg-brand-accent/10 flex items-center justify-center mb-6 border border-brand-accent/20 group-hover:border-brand-accent/50 transition-colors shadow-lg shadow-brand-accent/5">
                            <span
                                class="material-symbols-outlined text-brand-accent text-2xl font-black">monitoring</span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-white mb-3">Analítica de Rendimiento</h3>
                        <p class="text-slate-400 text-sm leading-relaxed mb-6 font-medium">
                            Métricas operativas del negocio en tiempo real. Visualiza los registros históricos de socios
                            mediante un gráfico lineal personalizado con Chart.js.
                        </p>
                    </div>
                    <ul class="space-y-2.5 border-t border-slate-800/80 pt-4">
                        <li class="flex items-center gap-2 text-xs font-bold text-slate-300">
                            <span class="material-symbols-outlined text-brand-accent text-lg">check_circle</span>
                            Seguimiento de ingresos y deserción
                        </li>
                        <li class="flex items-center gap-2 text-xs font-bold text-slate-300">
                            <span class="material-symbols-outlined text-brand-accent text-lg">check_circle</span>
                            Visualización de crecimiento real
                        </li>
                    </ul>
                </div>
            </div>
        </section>


        <section class="px-8 py-24 max-w-7xl mx-auto">
            <div
                class="neon-card p-12 lg:p-20 rounded-3xl relative overflow-hidden text-center border-2 border-brand-accent/25 shadow-2xl">

                <div class="absolute inset-0 bg-brand-accent/5 pointer-events-none"></div>
                <div
                    class="absolute -left-12 -top-12 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none">
                </div>

                <h2
                    class="font-display text-3xl lg:text-5xl font-black text-white mb-4 relative z-10 uppercase tracking-tight">
                    ¿LISTO PARA LIDERAR TU GIMNASIO?</h2>
                <p class="text-slate-400 text-base max-w-xl mx-auto relative z-10 font-medium mb-8">
                    Únete a los coaches y centros de entrenamiento que maximizan sus métricas operativas y rutinas
                    diarias con NovaGym.
                </p>

                <section id="comenzar" class="px-8 py-24 max-w-7xl mx-auto">
                    <div class="flex justify-center relative z-10">
                        <a href="{{ route('login') }}"
                            class="px-10 py-4 bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold rounded-xl shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:brightness-110 hover:scale-105 transition-all duration-200 text-sm">
                            Empezar Ahora
                        </a>
                    </div>
            </div>
        </section>
    </main>


    <footer class="bg-brand-darkest border-t border-slate-800 py-8 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-center px-8 w-full max-w-7xl mx-auto gap-4">
            <div class="text-center md:text-left space-y-1.5">
                <div class="flex items-center gap-2 justify-center md:justify-start">
                    <span class="material-symbols-outlined text-brand-accent text-xl font-black select-none">bolt</span>
                    <span class="font-display font-black text-white text-lg tracking-tight uppercase">NOVA<span
                            class="text-brand-accent font-display">GYM</span></span>
                </div>
                <p class="text-slate-500 text-xs font-medium">© 2026 NovaGym Performance Systems. Todos los derechos
                    reservados.</p>
            </div>
            <div class="flex gap-6 text-xs font-bold font-display">
                <a class="text-slate-400 hover:text-brand-accent transition-colors" href="#">POLÍTICA DE PRIVACIDAD</a>
                <a class="text-slate-400 hover:text-brand-accent transition-colors" href="#">TÉRMINOS DE SERVICIO</a>
            </div>
        </div>
    </footer>
</body>

</html>