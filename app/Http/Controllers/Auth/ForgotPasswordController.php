<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['success' => 'Te hemos enviado por correo el enlace para restablecer tu contraseña.']);
        }

        return back()->withErrors(['email' => 'No se pudo enviar el correo de recuperación.']);
    }
}
