<?php
    namespace App\Http\Controllers;

	use App\Models\Page;
	use App\Models\Panel;
	use App\Models\PagePanel;
	use App\Repositories\RepositoryInterfaces\ISidebarRepository;
	use App\Repositories\RepositoryInterfaces\IIntroductionRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IPanelRepository;
	use App\Repositories\RepositoryInterfaces\IPagePanelRepository;
	
	use App\Http\Requests;
	use App\Http\Requests\Page\PageRequest;
	
	use Auth;
	use Redirect;
	use Request;
	use View;


    class PageController extends Controller
    {

    	public function __construct(IIntroductionRepository $introrepo, IPageRepository $pagerepo, 
    								IPanelRepository $panelrepo, IPagePanelRepository $pagepanelrepo, ISidebarRepository $sidebarrepo){
    		
    		$this->introrepo = $introrepo;
    		$this->pagerepo = $pagerepo;
    		$this->panelrepo = $panelrepo;
    		$this->pagepanelrepo = $pagepanelrepo;
    		$this->sidebarrepo = $sidebarrepo;
    	}


        /**
         * Display a listing of the resource.
         *
         * @return Response
         */

        public function index()
        {	
           $pages = $this->pagerepo->getAll();

           return view('page.index', compact('pages'));
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

            $page = $this->pagerepo->create([
            	'introduction_introductionId' => $introId,
            	'sidebar' => $request->sidebar,
            	]);

            if(count($request->panel) > 0){
            foreach($request->panel as $pagepanel){
            	$panel = $this->panelrepo->getBySize($pagepanel['size']);

            	$this->pagepanelrepo->create([
            		'page_id' => $page->pageId,
            		'title' => $pagepanel['title'],
            		'text' => $pagepanel['content'],
            		'panel_id' =>$panel->panelId
            	]);
            }
        }

            $pageid = $page->pageId;

            if($request->sidebar){
            	$sidebar = $this->sidebarrepo->create([
            		'pageNr' => $pageid,
            		'page_pageId' => $pageid,
            		'rowNr' => 0,
            		'title' => $request->title,
            		'text' => 'Home',
            		'extern' => 'false',
            		'link' => '/'
            		]);
            }

           return Redirect::route('page.show', [$page->pageId]);
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return Response
         */
        public function show($id)
        {
            $page = $this->pagerepo->get($id);
           	if(isset($page)){
	            if($page->sidebar){
	            	$sidebar = $this->sidebarrepo->getByPage($page->pageId);
	            	return View('page.show', compact('page', 'sidebar'));
	            } else {
					return View('page.show', compact('page'));
	            }
	        }else {
	        	return view('errors.404');
	        }
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return Response
         */
        public function edit($id)
        {
            $page = $this->pagerepo->get($id);
            if(isset($page)){
            	return View('page.edit', compact('page'));
            } else {
	        	return view('errors.404');
	        }

        }

        /**
         * Update the specified resource in storage.
         *
         * @param  int  $id
         * @return Response
         */
        public function update($id, PageRequest $request)
        {
            
        	$old = $this->pagerepo->get($id)->sidebar;
        	$new = $request->sidebar;

        	// update introduction
        	$introduction = $this->introrepo->get($request->intro_id);
        	$introduction->title = $request->title;	
        	$introduction->text = $request->content;

        	$this->introrepo->update($introduction);

        	// update page
			$page = $this->pagerepo->get($id);	
			$page->sidebar = $request->sidebar;
			$this->pagerepo->update($page);

			// delete all old panels 
			$this->pagepanelrepo->deleteAllFromPage($id);

        	// update panels 
			if(count($request->panel) > 0){
            foreach($request->panel as $pagepanel){
            	$panel = $this->panelrepo->getBySize($pagepanel['size']);
	          		
				$this->pagepanelrepo->create([
					'page_id' => $page->pageId,
					'title' => $pagepanel['title'],
					'text' => $pagepanel['content'],
					'panel_id' =>$panel->panelId
					]);					
            	}
        	}

        	$pageid = $page->pageId;
        	$title = $request->title;
        	$this->updateSidebar($old, $new, $pageid, $title);

        	return Redirect::route('page.show', [$page->pageId]);

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

        /**
         * When old is the same as $new, both are false or true
         *	
		 */
        private function updateSidebar($old, $new, $pageid, $title){

        	if($old === $new){
        		// do nothing
        	} else{   
        		if($new){
        			$sidebar = $this->sidebarrepo->create([
            		'pageNr' => $pageid,
            		'page_pageId' => $pageid,
            		'rowNr' => 0,
            		'title' => $title,
            		'text' => 'Home',
            		'extern' => 'false',
            		'link' => '/'
            		]);
        		} else {
        			$this->sidebarrepo->deleteAllFromPage($pageid);
        		}

        	}
        }
    }