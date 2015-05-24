<?php
	namespace App\Http\Controllers;

	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use Illuminate\Http\Request;
	use App\Models\User;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use Auth;


	class PermissionsController extends Controller {

		public function __construct(IUserRepository $userRepo, IPageRepository $pageRepo, IDistrictSectionRepository $districtSectionRepo)
		{
			$this->userRepo = $userRepo;
			$this->pageRepo = $pageRepo;
			$this->districtSectionRepo = $districtSectionRepo;
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function editUserPermissions($userId)
		{
			$user = $this->userRepo->get($userId);
			$pages = $this->pageRepo->getAll();
			$pageSelection = 'hello world';

			return view('permissions.editUserPermissions', compact('user', 'pages', 'pageSelection'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function updateUserPermissions($userId, Request $request)
		{
			$pageSelectionString = $request->get('pageSelection');
			$pageSelectionArray = json_decode($pageSelectionString);
			$arr = ['hello', 'world'];

			dd($arr);
			return 'update user permissions '.$userId.'';
		}


	}
