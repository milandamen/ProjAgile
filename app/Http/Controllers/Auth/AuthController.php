<?php
    namespace App\Http\Controllers\Auth;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Auth\LoginRequest;
    use App\Http\Requests\Auth\RegisterRequest;
    use App\Repositories\RepositoryInterfaces\IUserRepository;
    use Illuminate\Contracts\Auth\Guard;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Redirect;

    class AuthController extends Controller
    {
        private $auth;
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
                'firstName',
                'surname',
                'address',
                'houseNumber',
                'zipCode',
                'location',
                'emailAddress',
                'phoneNumber',
                'mobileNumber'
            );
            $data['password'] = Hash::make($request['password']);
            $user = $this->userRepo->create($data);
            $this->auth->login($user);

            return Redirect::route('home');
        }

        public function getLogin()
        {
            return view('auth.login');
        }

        public function postLogin(LoginRequest $request)
        {
            $credentials = $request->only('emailAddress', 'password');
            $credentials['active'] = true;
            
            if ($this->auth->attempt($credentials, $request['remember']))
            {
                Flash::success('U bent succesvol ingelogd!');
                return Redirect::route('home');
            }

            return Redirect::route('login')->withErrors
            ([
                'emailAddress' => 'Het ingevoerde emailadres met wachtwoord combinatie klopt helaas niet. Wilt u het opnieuw proberen?',
            ]);
        }

        public function getLogout()
        {
            $this->auth->logout();
            Flash::success('U bent succesvol uitgelogd!');

            return Redirect::route('home');
        }
    }