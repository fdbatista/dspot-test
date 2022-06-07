<?php

namespace App\Http\Middleware;

use App\Repositories\JwtRepository;
use App\Utils\JWTUtil;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JwtAuth
{
    private const ERROR_MESSAGE = 'Invalid or expired token';

    private JwtRepository $jwtRepository;

    public function __construct(JwtRepository $jwtRepository)
    {
        $this->jwtRepository = $jwtRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse|JsonResponse
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse|JsonResponse
    {
        $authHeader = $request->header('Authorization');
        $jwt = str_replace('Bearer ', '', $authHeader);

        if (!$this->jwtRepository->exists(['token' => $jwt])) {
            $this->throwException();
        }

        $payload = JWTUtil::decodeJWT($jwt);

        if (!$payload) {
            $this->throwException();
        }

        return $next($request);
    }

    /**
     * @throws Exception
     */
    private function throwException() {
        throw new Exception(self::ERROR_MESSAGE);
    }
}
