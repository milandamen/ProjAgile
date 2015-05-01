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
    const ADMIN_GROUP_ID = 1;
    const CONTENT_GROUP_ID = 2;
    const RESIDENT_GROUP_ID = 3;

    public function __construct(IUserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index($crit = null)
    {
        if (Auth::check())
        {
            if (Auth::user()->usergroup->name === 'Administrator')
            {
                if ((Request::get('search') === null || Request::get('search') === '') && $crit === null)
                {
                    $admins = $this->userRepo->getAllByUserGroup(self::ADMIN_GROUP_ID);
                    $contentmanagers = $this->userRepo->getAllByUserGroup(self::CONTENT_GROUP_ID);
                    $residents = $this->userRepo->getAllByUserGroup(self::RESIDENT_GROUP_ID);
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
                    $admins = $this->userRepo->filterAllByUserGroup(self::ADMIN_GROUP_ID, $criteria);
                    $contentmanagers = $this->userRepo->filterAllByUserGroup(self::CONTENT_GROUP_ID, $criteria);
                    $residents = $this->userRepo->filterAllByUserGroup(self::RESIDENT_GROUP_ID, $criteria);
                    $count = count($admins) + count($contentmanagers) + count($residents);
                }
                return view('user.index', compact('admins', 'contentmanagers', 'residents', 'criteria', 'count'));
            }
            return view('errors.403');
        }
        return view('errors.401');
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