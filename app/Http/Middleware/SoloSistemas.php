<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Solo deja pasar a usuarios con el rol Sistemas (principal o adicional).
 * Cualquier otro rol recibe 403 aunque escriba la URL a mano (RF-01).
 */
class SoloSistemas
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('voyager.login');
        }
        if (!$user->hasRole('Sistemas')) {
            abort(403, 'Solo el rol Sistemas puede usar esta pantalla.');
        }

        return $next($request);
    }
}
