<?php namespace App\Http\Middleware;

use Closure;
use App\Repositories\RepositoryInterfaces\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class AdminMiddleware {

    private $auth;
    private $userRepo;

    public function __construct(IUserRepository $userRepo, Guard $auth)
    {
        $this->userRepo = $userRepo;
        $this->auth = $auth;
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
        if ($this->auth->check())
        {
            if ($this->userRepo->isUserAdministrator($request->user()) ||
                $this->userRepo->isUserContentAdministrator($request->user()))
            {
                return $next($request);
            }
            abort(403, 'Unauthorized.');
        }
        return redirect('inloggen');
	}

}
