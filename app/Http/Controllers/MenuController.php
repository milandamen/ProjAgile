<?php
	namespace App\Http\Controllers;

	use App\Http\Requests\Menu\MenuRequest;
	use App\Models\Menu;
	use App\Repositories\RepositoryInterfaces\IMenuRepository;
	use App\Repositories\RepositoryInterfaces\IStyleSettingRepository;
	use Auth;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Redirect;

	class MenuController extends Controller 
	{
		/**
		 * The IMenuRepository implementation.
		 * 
		 * @var IMenuRepository
		 */
		private $menuRepo;

		/**
		 * The IStyleSettingRepository implementation.
		 * 
		 * @var IStyleSettingRepository
		 */
		private $styleRepo;

		/**
		 * Create a new MenuController instance.
		 *
		 * @param IMenuRepository			$menuRepo
		 * @param IStyleSettingRepository	$styleRepo
		 *
		 * @return void
		 */
		public function __construct(IMenuRepository $menuRepo, IStyleSettingRepository $styleRepo)
		{
			$this->menuRepo = $menuRepo;
			$this->styleRepo = $styleRepo;
		}

		/**
		 * Show the menu overview page.
		 * 
		 * @return Response
		 */
		public function index()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_MENU))
			{
				$allMenuItemsEdit = $this->menuRepo->getAllMenuItems();
				$menuColor = $this->styleRepo->get('defaultMenuColor');

				return view('menu.index', compact('allMenuItemsEdit', 'menuColor'));
			}

			return view('errors.403');
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_MENU))
			{
				$menuItem = new Menu();

				return view('menu.create', compact('menuItem'));
			}

			return view('errors.403');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store(MenuRequest $request)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_MENU))
			{
				$this->menuRepo->create($request->all());

				return Redirect::route('menu.index');
			}

			return view('errors.403');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 * 
		 * @return Response
		 */
		public function edit($id)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_MENU))
			{
				$menuItem = $this->menuRepo->get($id);

				return view('menu.edit', compact('menuItem'));
			}

			return view('errors.403');
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int $id
		 * 
		 * @return Response
		 */
		public function update(MenuRequest $request)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_MENU))
			{
				$item = $this->menuRepo->get($request->id);
				$item->name = $request->name;
				$item->link = $request->link;
				$item->publish = $request->publish;
				$this->menuRepo->update($item);

				return Redirect::route('menu.index');
			}

			return view('errors.403');
		}

		/**
		 * Post and handle the reordening request.
		 * 
		 * @param  Request $request
		 * 
		 * @return Response
		 */
		public function updateMenuOrder(Request $request)
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_MENU))
			{
				$parentId = null;
				$array = [];
				$allMenuItems = $this->menuRepo->getAll();

				// Loop trough the names of the textfields.
				foreach ($request->all() as $key => $requestItem) 
				{
					if (!is_string($key)) 
					{
						foreach ($allMenuItems as $oldIndex => $oldItem) 
						{
							if ($oldItem->menuId == $key) 
							{
								unset($allMenuItems[$oldIndex]);

								break;
							}
						}
						$requestItemPart = explode(".", $requestItem);

						if ($requestItemPart[0] == 0) 
						{
							$array = [];
							$this->menuRepo->updateMenuItemOrder($key, $requestItemPart[1], NULL);
						} 
						else 
						{
							if (isset($array[$requestItemPart[0]]) || empty($array[$requestItemPart[0]])) 
							{
								$array = array_add($array, $requestItemPart[0], $parentId);
							}
							$this->menuRepo->updateMenuItemOrder($key, $requestItemPart[1], $array[$requestItemPart[0]]);
						}
						$parentId = $key;
					}
					elseif ($key == 'menucolor') 
					{
						$model = $this->styleRepo->get('defaultMenuColor');
						$model->color = $requestItem;
						$this->styleRepo->update($model);
					}
				}

				foreach ($allMenuItems as $oldItem) 
				{
					$this->menuRepo->destroy($oldItem->menuId);
				}

				return Redirect::route('menu.index');
			}

			return view('errors.403');
		}

		/**
		 * Toggle the publish state of a menu item.
		 * 
		 * @param  int $id
		 * 
		 * @return void
		 */
		public function switchPublish($id)
		{
			$menuItem = $this->menuRepo->get($id);
			$menuItem->publish ? $menuItem->publish = false : $menuItem->publish = true;
			$this->menuRepo->update($menuItem);
		}
	}