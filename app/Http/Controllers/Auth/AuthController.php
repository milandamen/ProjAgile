<?php
    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Auth\LoginRequest;
    use App\Http\Requests\Auth\RegisterRequest;
    use App\Repositories\RepositoryInterfaces\IUserRepository;
    use Auth;
    use Flash;
    use Illuminate\Contracts\Auth\Guard;
    use Redirect;

    class AuthController extends Controller
    {
        /**
         * The Guard implementation.
         *
         * @var Guard
         */
        private $auth;

        /**
         * The UserRepository implementation.
         * 
         * @var IUserRepository
         */
        private $userRepo;

        public function __construct(Guard $auth, IUserRepository $userRepo)
        {
            $this->auth = $auth;
            $this->userRepo = $userRepo;

            $this->middleware('guest', 
            [
                'except' => 'getLogout'
            ]);
        }

        public function getRegister()
        {
            return view('auth.register');
        }

        public function postRegister(RegisterRequest $request)
        {
            $data = $request->only
            (
                'username',
                'password',
                'firstName',
                'surname',
                'postal',
                'houseNumber',
                'email'
            );
            $user = $this->userRepo->create($data);
            $this->auth->login($user);
            Flash::success('U bent succesvol geregistreerd en u bent nu ingelogd.');

            return Redirect::route('home.index');
        }

        public function getLogin()
        {
            return view('auth.login');
        }

        public function postLogin(LoginRequest $request)
        {
            $credentials = $request->only('username', 'password');
            $credentials['active'] = true;

            if (!$this->auth->attempt($credentials, $request['remember']))
            {
                return Redirect::route('auth.login')->withErrors
                ([
                    'username' => 'De ingevoerde gebruikersnaam met wachtwoord combinatie klopt helaas niet. Probeer het alstublieft opnieuw.',
                ]);
            }
            Flash::success('U bent succesvol ingelogd!');

            return Redirect::route('home.index');
        }

        public function getLogout()
        {
            if (Auth::check())
            {
                $this->auth->logout();
                Flash::success('U bent succesvol uitgelogd!');
            }
            else
            {
                Flash::info('U bent nog niet ingelogd. Hierdoor kunt u niet uitloggen.');
            }
            return Redirect::route('home.index');
        }
    }