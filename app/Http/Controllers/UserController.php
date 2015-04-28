<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 26-4-2015
 * Time: 21:04
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
use App\Repositories\RepositoryInterfaces\IUserRepository;
use App\Repositories\RepositoryInterfaces\ISidebarRepository;
use Auth;
use Redirect;
use Request;
use View;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo->getAll();

        $admins = $this->userRepo->getAllByUserGroup(1);
        $contentmanagers = $this->userRepo->getAllByUserGroup(2);
        $residents = $this->userRepo->getAllByUserGroup(3);

        return view('user.index', compact('admins', 'contentmanagers', 'residents'));
    }

    public function create()
    {
        if (Auth::check())
        {
            if (Auth::user()->usergroup->name === 'Administrator')
            {
                $user = new User();
                return view('user.create', compact('user'));
            }
            return view('errors.403');
        }
        return view('errors.401');
    }

    public function store()
    {
        if (Auth::check())
        {
            if (Auth::user()->usergroup->name === 'Administrator')
            {
                $data = Request::input();
                $user = $this->userRepo->create($data);
                return redirect::route('user.index');
            }
            return view('errors.403');
        }
        return view('errors.401');
    }

    public function edit($id)
    {
        if (Auth::check())
        {
            if (Auth::user()->usergroup->name === 'Administrator')
            {
                $user = $this->userRepo->get($id);
                return view('user.edit', compact('user'));
            }
            return view('errors.403');
        }
        return view('errors.401');
    }

    public function update($id)
    {
        if (Auth::check())
        {
            if (Auth::user()->usergroup->name === 'Administrator') {
                $user = $this->userRepo->get($id);
                $user->username = Request::get('username');
                $user->firstName = Request::get('firstName');
                $user->surname = Request::get('surname');
                $user->email = Request::get('email');

                if (Request::get('password') != '')
                {
                    $user->password = Request::get('password');
                }
                //$user->fill(Request::input());
                $this->userRepo->update($user);

                return redirect::route('user.index');
            }

            return view('errors.403');
        }

        return view('errors.401');
    }

}