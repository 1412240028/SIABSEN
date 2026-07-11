<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Contoh pakai: ->middleware('role:admin') atau ->middleware('role:admin,dosen')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $effectiveRole = $this->resolveEffectiveRole($user);

        if (! in_array($effectiveRole, $roles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }

    protected function resolveEffectiveRole($user): ?string
    {
        if (! empty($user->role)) {
            return $user->role;
        }

        if ($user->dosen()->exists()) {
            return 'dosen';
        }

        if ($user->mahasiswa()->exists()) {
            return 'mahasiswa';
        }

        return null;
    }
}
