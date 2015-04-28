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
            dd($request);
        }
    }