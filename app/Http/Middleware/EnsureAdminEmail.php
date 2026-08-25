<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminEmail
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedEmails = array_map(
            static fn (string $email): string => strtolower(trim($email)),
            config('dealer.admin_emails', [])
        );

        $userEmail = strtolower(trim((string) $request->user()?->email));

        abort_unless($userEmail !== '' && in_array($userEmail, $allowedEmails, true), 403);

        return $next($request);
    }
}
