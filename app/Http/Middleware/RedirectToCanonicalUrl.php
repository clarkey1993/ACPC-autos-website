<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToCanonicalUrl
{
    /**
     * Redirect every public hostname and protocol variant to one canonical URL.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('seo.enforce_canonical_url')) {
            return $next($request);
        }

        $canonicalUrl = rtrim((string) config('seo.canonical_url'), '/');
        $canonicalParts = parse_url($canonicalUrl);

        if (! is_array($canonicalParts) || empty($canonicalParts['scheme']) || empty($canonicalParts['host'])) {
            return $next($request);
        }

        $canonicalScheme = strtolower($canonicalParts['scheme']);
        $canonicalHost = strtolower($canonicalParts['host']);
        $canonicalPort = $canonicalParts['port'] ?? ($canonicalScheme === 'https' ? 443 : 80);

        $isCanonicalRequest = strtolower($request->getScheme()) === $canonicalScheme
            && strtolower($request->getHost()) === $canonicalHost
            && $request->getPort() === $canonicalPort;

        if ($isCanonicalRequest) {
            return $next($request);
        }

        $status = in_array($request->getMethod(), ['GET', 'HEAD'], true) ? 301 : 308;

        return redirect()->away($canonicalUrl.$request->getRequestUri(), $status);
    }
}
