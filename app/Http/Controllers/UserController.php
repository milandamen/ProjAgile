<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 26-4-2015
 * Time: 21:04
 */

namespace App\Http\Controllers;

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
        return view('user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = $this->userRepo->get($id);
        return view('user.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        if (Auth::check())
        {
            if (Auth::user()->usergroup->name === 'Administrator') {
                $user = $this->userRepo->get($id);
                $user->fill($request->input());
                $this->userRepo->update($user);

                return redirect('user.index');

            }

            return view('errors.403');
        }

        return view('errors.404');
    }

}