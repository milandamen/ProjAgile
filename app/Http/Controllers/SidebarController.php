<?php
    namespace App\Http\Controllers;

    use App\Models\Sidebar;
    use App\Repositories\RepositoryInterfaces\ISidebarRepository;
    use Illuminate\Support\Facades\Redirect;

    class SidebarController extends Controller
    {
        private $sidebarRepo;

        /**
         * Create a new SidebarController instance.
         *
         * @parm ISidebarRepository $sidebarRepo
         *
         * @return void
         */
        public function __construct(ISidebarRepository $sidebarRepo)
        {
            $this->sidebarRepo = $sidebarRepo;
        }

        public function edit($id)
        {
            if($this->sidebarRepo->getByPage($id) != null)
            {
                $sidebar = $this->sidebarRepo->getByPage($id);

                 return View('sidebar.edit', compact('sidebar'));
            }
            else
            {
                // Totdat er een error page is.
                return Redirect::route('home.index');
            }
        }

        public function update($id)
        {
            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $maxrowindex = $_POST['maxRowIndex'];
            $i=0;
            $pageNr = $id;

            for($rows =0; $rows <= $maxrowindex; $rows++)
            {
                echo $rows;

                if(isset($_POST['sidebar'][$rows]))
                {
                    $rowItems = $_POST['sidebar'][$rows];
                    for($row = 0; $row < count($rowItems['text']); $row++)
                    {
                        if($rowItems['text'][$row] != null)
                        {
                            $link =  $rowItems['link'][$row];
                            $extern = false;

                            if($rowItems['radio1'] == 'Extern')
                            {
                                $extern = true;
                                $link = $rowItems['link'][$row];
                            } else
                            {
                                if($rowItems['pagename'][$row] != '')
                                {
                                    $link = $rowItems['pagename'][$row];
                                }
                                else
                                {
                                    $link = $rowItems['link'][$row];
                                }
                                $extern = false;
                            }
                            $text = filter_var($rowItems['text'][$row], FILTER_SANITIZE_STRING);

                            if(isset($rowItems['rowId'][$row]))
                            {
                                $rowId = $rowItems['rowId'][$row];
                                $sideRow = $this->sidebarRepo->getSideRow($pageNr,$rowId);

                                if($sideRow != null)
                                {
                                    $sideRow->pageNr = $pageNr;
                                    $sideRow->rowNr = $i;
                                    $sideRow->title= $title;
                                    $sideRow->text = $text;
                                    $sideRow->link= $link;
                                    $sideRow->extern= $extern;
                                    $sideRow->save();
                                }
                            }
                            else
                            {
                                $newSidebarRow = new Sidebar();
                                $newSidebarRow->pageNr = $pageNr;
                                $newSidebarRow->rowNr = $i;
                                $newSidebarRow->title= $title;
                                $newSidebarRow->text = $text;
                                $newSidebarRow->link= $link;
                                $newSidebarRow->extern= $extern;
                                $newSidebarRow->save();
                            }
                            $i++;
                        }
                        else
                        {
                            echo "Vul a.u.b. alle verplichte velden in";
                            return;
                        }
                    }
                }
            }
            return Redirect::route('home.index');
        }
    }