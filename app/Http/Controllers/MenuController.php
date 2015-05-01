<?php
    namespace App\Http\Controllers;

    use App\Repositories\RepositoryInterfaces\IMenuRepository;
    use Illuminate\Http\Request;

    class MenuController extends Controller {

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */

        private $menuRepo;


        public function __construct(IMenuRepository $menuRepo)
        {
            $this->menuRepo = $menuRepo;
        }

        public function index()
        {
            $allMenuItems = $this->menuRepo->getAllMenuItems();
            return view('menu.index', compact('allMenuItems'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @return Response
         */
        public function store()
        {
            //
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  int  $id
         * @return Response
         */
        public function update($id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return Response
         */
        public function destroy($id)
        {
            //
        }

        public function updateMenuOrder(Request $request)
        {
            /*
            for($i = 2; $i < count($request->all()); $i++)
            {
                $request->all()[$i]->key();
                $request->all()[$i -1 ]->key();
            }
            */

            foreach($request->all() as $key => $requestItem) //loop trough the names of the textfields
            {
                if (! is_string ( $key )){
                    $requestItemPart = explode(".", $requestItem);
                        if (!$requestItemPart[0] == 0)
                        {

                        }
                        else
                        {
                            $parentId = $key;
                            $requestItemPart[0] = NULL;
                        }

                        $this->menuRepo->updateMenuItemOrder($key,$requestItemPart[1], $requestItemPart[1] );
                }
            }

        }
    }