<?php
	namespace App\Http\Controllers;

	use App\Models\Menu;
	use App\Repositories\RepositoryInterfaces\IMenuRepository;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Redirect;
	use App\Http\Requests\Menu\MenuRequest;

	class MenuController extends Controller 
	{
		private $menuRepo;

		public function __construct(IMenuRepository $menuRepo)
		{
			$this->menuRepo = $menuRepo;
		}

		public function index()
		{
			$allMenuItemsEdit = $this->menuRepo->getAllMenuItems();

			return view('menu.index', compact('allMenuItemsEdit'));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			$menuItem = new Menu();

			return view('menu.create', compact('menuItem'));
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @return Response
		 */
		public function store(MenuRequest $request)
		{
			$this->menuRepo->create($request->all());

			return Redirect::route ('menu.index');
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * 
		 * @return Response
		 */
		public function edit($id)
		{
			$menuItem = $this->menuRepo->get($id);

			return view('menu.edit', compact('menuItem'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  int  $id
		 * 
		 * @return Response
		 */
		public function update(MenuRequest $request)
		{
		   $item = $this->menuRepo->get($request->id);
		   $item->name = $request->name;
		   $item->link = $request->link;
		   $item->publish = $request->publish;
		   $this->menuRepo->update($item);

			return Redirect::route('menu.index');
		}

		public function updateMenuOrder(Request $request)
		{
			$parentId = null;
			$array = [];
			$allMenuItems = $this->menuRepo->getAll();

			foreach($request->all() as $key => $requestItem) //loop trough the names of the textfields
			{
				if (! is_string( $key ))
				{
					foreach($allMenuItems as $oldIndex => $oldItem)
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
						$this->menuRepo->updateMenuItemOrder($key, $requestItemPart[1], NULL );
					}
					else
					{
						if(isset($array[$requestItemPart[0]]) || empty($array[$requestItemPart[0]]))
						{
							$array = array_add($array, $requestItemPart[0], $parentId);
						}
						$this->menuRepo->updateMenuItemOrder($key, $requestItemPart[1], $array[$requestItemPart[0]]);
					}
					$parentId = $key;
				}
			}

			foreach($allMenuItems as $oldItem)
			{
				$this->menuRepo->destroy($oldItem->menuId);
			}

			return Redirect::route('menu.index');
		}

        public function switchPublish($id)
        {
            $menuItem = $this->menuRepo->get($id);
            if($menuItem->publish == 0)
            {
                $menuItem->publish = 1;
            }else{
                $menuItem->publish = 0;
            }
            $this->menuRepo->update($menuItem);
        }
	}