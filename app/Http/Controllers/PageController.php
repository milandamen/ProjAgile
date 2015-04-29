<?php
    namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IPanelRepository;
	use App\Repositories\RepositoryInterfaces\IPagePanelRepository;
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

    	public function __construct(IIntroductionRepository $introrepo, IPageRepository $pagerepo, 
    								IPanelRepository $panelrepo, IPagePanelRepository $pagepanelrepo){
    		
    		$this->introrepo = $introrepo;
    		$this->pagerepo = $pagerepo;
    		$this->panelrepo = $panelrepo;
    		$this->pagepanelrepo = $pagepanelrepo;
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
            $introduction = $this->introrepo->create([
            	'pageId' => 2,
            	'title' => $request->title, 
            	'text' => $request->content,
            	]);

            $introId = $introduction->introductionId;

            echo 'intro id ' . $introId;

            $page = $this->pagerepo->create([
            	'introduction_introductionId' => $introId,
            	'sidebar' => $request->sidebar,
            	]);

            echo ' page id ' . $page->pageId;

            foreach($request->panel as $pagepanel){
            	$panel = $this->panelrepo->getBySize($panel['size']);
            	$this->pagepanelrepo->create([
            		'page_id' => $page->pageId,
            		'title' => $pagepanel['title'],
            		'text' => $pagepanel['content'],
            		'panel_id' =>$panel->panelId
            	]);
            }
            
            echo ' saved';
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return Response
         */
        public function show($id)
        {
            
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