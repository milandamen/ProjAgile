<?php

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

    public function index($crit = null)
    {
        if ((Request::get('search') === null || Request::get('search') === '') && $crit === null)
        {
            $admins = $this->userRepo->getAllByUserGroup(1);
            $contentmanagers = $this->userRepo->getAllByUserGroup(2);
            $residents = $this->userRepo->getAllByUserGroup(3);
        }
        else
        {
            if ($crit !== null)
            {
                $criteria = $crit;
            }
            else
            {
                $criteria = Request::get('search');
            }
            $admins = $this->userRepo->filterAllByUserGroup(1, $criteria);
            $contentmanagers = $this->userRepo->filterAllByUserGroup(2, $criteria);
            $residents = $this->userRepo->filterAllByUserGroup(3, $criteria);
            $count = count($admins) + count($contentmanagers) + count($residents);
        }

        return view('user.index', compact('admins', 'contentmanagers', 'residents', 'criteria', 'count'));
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

                $this->userRepo->update($user);

                return redirect::route('user.index');
            }

            return view('errors.403');
        }

        return view('errors.401');
    }

    public function deactivate($id, $crit = null)
    {
        if (Auth::check())
        {
            if (Auth::user()->usergroup->name === 'Administrator') {
                $user = $this->userRepo->get($id);
                $user->active = 0;
                $this->userRepo->update($user);

                return redirect::route('user.index', [$crit]);
            }

            return view('errors.403');
        }

        return view('errors.401');
    }

    public function activate($id, $crit = null)
    {
        if (Auth::check())
        {
            if (Auth::user()->usergroup->name === 'Administrator') {
                $user = $this->userRepo->get($id);
                $user->active = 1;
                $this->userRepo->update($user);

                return redirect::route('user.index', [$crit]);
            }

            return view('errors.403');
        }

        return view('errors.401');
    }

}