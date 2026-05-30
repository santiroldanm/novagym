<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.'
        ]);

        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['success' => 'Te hemos enviado por correo el enlace para restablecer tu contraseña.']);
        }

        
        $messages = [
            Password::INVALID_USER => 'No existe ningún usuario registrado con esa dirección de correo electrónico.',
            Password::RESET_THROTTLED => 'Has solicitado restablecer tu contraseña demasiadas veces. Por favor, espera un momento antes de volver a intentarlo.',
        ];

        $error = $messages[$status] ?? 'No se pudo enviar el correo de recuperación. Revisa la configuración de red.';

        return back()->withErrors(['email' => $error]);
    }
}
