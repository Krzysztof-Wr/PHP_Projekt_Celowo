<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // jeśli ktoś nie jest zalogowany
        if (!$user) {
            return redirect('/login');
        }

        // jeśli rola użytkownika jest na liście dozwolonych
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // jeśli nie ma uprawnień
        abort(403, 'Brak uprawnień');
    }
}
