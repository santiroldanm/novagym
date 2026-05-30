<!DOCTYPE html>
<html class="dark" lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Restablecer Contraseña - NovaGym</title>
    
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@700;800;900&family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        brand: {
                            darkest: "#030712",
                            dark: "#0b0f19",
                            card: "#0f172a",
                            accent: "#00f0ff",
                            border: "#1e293b"
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
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        .neon-card {
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(30, 41, 59, 0.7);
            transition: all 0.3s ease;
        }
        .neon-card:hover {
            border-color: rgba(0, 240, 255, 0.4);
            box-shadow: 0 0 25px rgba(0, 240, 255, 0.12);
        }
        .text-glow {
            text-shadow: 0 0 10px rgba(0, 240, 255, 0.5);
        }
        .focus-cyan:focus {
            border-color: #00f0ff !important;
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.25) !important;
        }
    </style>
</head>
<body class="bg-brand-darkest min-h-screen flex items-center justify-center p-6 relative">
    
    
    <div class="absolute w-96 h-96 bg-brand-accent/5 blur-[120px] top-10 left-10 pointer-events-none"></div>
    <div class="absolute w-96 h-96 bg-blue-500/5 blur-[120px] bottom-10 right-10 pointer-events-none"></div>

    <div class="w-full max-w-[450px] z-10 space-y-6">
        
        <div class="flex items-center gap-2.5 justify-center">
            <span class="material-symbols-outlined text-brand-accent text-[38px] font-black text-glow">bolt</span>
            <span class="text-3xl font-display font-black text-white text-glow tracking-tight uppercase">NOVA<span class="text-brand-accent">GYM</span></span>
        </div>

        
        <div class="neon-card p-8 rounded-2xl shadow-2xl border border-brand-border/60">
            <div class="mb-6">
                <h2 class="text-xl font-bold font-display text-white uppercase">Crear Nueva Contraseña</h2>
                <p class="text-xs text-slate-400 font-medium mt-1">Ingresa tu nueva contraseña para acceder a tu cuenta.</p>
            </div>

            @if($errors->any())
                <div class="mb-4 bg-red-900/50 border border-red-500 text-red-400 px-4 py-3 rounded-xl text-sm font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required readonly
                        class="focus-cyan w-full bg-slate-900 border border-slate-800 rounded-xl py-3 px-4 text-slate-400 cursor-not-allowed focus:outline-none transition-all duration-300 text-sm">
                </div>

                <div>
                    <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Nueva Contraseña</label>
                    <input type="password" id="password" name="password" required placeholder="Min 8 caracteres"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-700 focus:outline-none transition-all duration-300 text-sm">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Min 8 caracteres"
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-700 focus:outline-none transition-all duration-300 text-sm">
                </div>

                
                <button type="submit" 
                    class="w-full py-3 bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-[0.98] transition-all duration-150 text-sm mt-6 flex items-center justify-center gap-2 shadow-[0_0_15px_rgba(0,240,255,0.15)]">
                    <span class="material-symbols-outlined text-[20px] font-black">lock_reset</span>
                    Actualizar Contraseña
                </button>
            </form>
        </div>
    </div>
</body>
</html>
