<!DOCTYPE html>
<html class="dark" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Iniciar Sesión - NovaGym</title>


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
            <span class="text-3xl font-display font-black text-white text-glow tracking-tight uppercase">NOVA<span
                    class="text-brand-accent">GYM</span></span>
        </div>


        <div class="neon-card p-8 rounded-2xl shadow-2xl border border-brand-border/60">
            <div class="mb-6">
                <h2 class="text-xl font-bold font-display text-white uppercase">Acceso Administrativo</h2>
                <p class="text-xs text-slate-400 font-medium mt-1">Ingresa tus credenciales autorizadas de entrenador o
                    gestor.</p>
            </div>


            @if($errors->any())
                <div class="mb-5 bg-red-950/40 border border-red-500/30 text-slate-200 p-4 rounded-xl text-xs space-y-1">
                    <div class="flex items-center gap-1.5 text-red-400 font-bold mb-1">
                        <span class="material-symbols-outlined text-sm font-bold">error</span>
                        <span>Error al autenticar:</span>
                    </div>
                    <ul class="list-disc pl-4 text-slate-300">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf


                <div>
                    <label for="email"
                        class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 font-display">Correo
                        Electrónico</label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email', 'albertogutierrezbedoya@gmail.com') }}" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-700 focus:outline-none transition-all duration-300 text-sm">
                </div>


                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password"
                            class="block text-[10px] font-black text-slate-400 uppercase tracking-widest font-display">Contraseña</label>
                        <a href="{{ route('password.request') }}"
                            class="text-[10px] font-bold text-brand-accent hover:underline uppercase tracking-wide">¿Olvidaste
                            tu contraseña?</a>
                    </div>
                    <input type="password" name="password" id="password" value="password" required
                        class="focus-cyan w-full bg-slate-950/60 border border-slate-800 rounded-xl py-3 px-4 text-white placeholder-slate-700 focus:outline-none transition-all duration-300 text-sm">
                </div>



                <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-brand-accent to-cyan-600 text-brand-darkest font-display font-bold rounded-xl hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] hover:scale-[0.98] transition-all duration-150 text-sm mt-6 flex items-center justify-center gap-2 shadow-[0_0_15px_rgba(0,240,255,0.15)]">
                    <span class="material-symbols-outlined text-[20px] font-black">login</span>
                    Entrar al Sistema
                </button>
            </form>


            <div class="mt-8 border-t border-slate-800/80 pt-4 text-center">
                <p class="text-xs text-slate-400 font-medium">
                    ¿Aún no tienes cuenta administrativa?
                    <a href="{{ route('register') }}"
                        class="text-brand-accent hover:underline font-bold font-display tracking-wide uppercase ml-1">Regístrate</a>
                </p>
            </div>
        </div>


        <div class="text-center">
            <a href="/"
                class="text-xs text-slate-500 hover:text-white transition-colors flex items-center justify-center gap-1 font-bold font-display uppercase tracking-widest">
                <span class="material-symbols-outlined text-sm font-bold">arrow_back</span> Volver a la Landing
            </a>
        </div>
    </div>

</body>

</html>