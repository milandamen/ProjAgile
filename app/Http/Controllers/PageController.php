<?php
    namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Http\Requests;
	use App\Http\Requests\Page\PageRequest;
	use App\Models\Page;
	use App\Models\Panel;
	use App\Models\PagePanel;
	use Auth;
	use Redirect;
	use Request;
	use View;


    class PageController extends Controller
    {

    	public function __construct(IIntroductionRepository $introrepo){
    		$this->introrepo = $introrepo;

    	}


        /**
         * Display a listing of the resource.
         *
         * @return Response
         */

        public function index()
        {
           //
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            // 
            return view('page.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @return Response
         */
        public function store(PageRequest $request)
        {
            $this->introrepo->create([
            	'pageId' => 2,
            	'title' => $request->title, 
            	'text' => $request->content,
            	]);

            echo 'saved introduction';
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
    }