<?php

namespace App\Http\Middleware;



use App\Traits\ApiResponser;
use Closure;
use Exception;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facdes\Log;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Authenticate
{
    use ApiResponser;
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if ($this->auth->guard($guard)->guest()) {
            try {
                auth()->payload();
            } catch (TokenExpiredException  $e) {
                return $this->errorResponse('Token expirado', Response::HTTP_UNAUTHORIZED);
                // do something
            } catch (TokenInvalidException  $e) {
                return $this->errorResponse('Token inválido', Response::HTTP_UNAUTHORIZED);
            } catch (Exception  $e) {

                return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

                //return $this->errorResponse('Token inválido' , Response::HTTP_SERVICE_UNAVAILABLE);
            }
        }

        return $next($request);
    }
}
