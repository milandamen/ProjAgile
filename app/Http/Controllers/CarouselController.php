<?php
    namespace App\Http\Controllers;

    use App\Models\Carousel;
    use App\Repositories\RepositoryInterfaces\ICarouselRepository;
    use Illuminate\Support\Facades\Redirect;

    class CarouselController extends Controller
    {
        private $carouselRepo;
		
		// minimum and maximum number that is prepended to image file
		private $minRand = 100000;
		private $maxRand = 999999;

        /**
         * Create a new CarouselController instance.
         *
         * @parm ICarouselRepository $carouselRepo
         *
         * @return void
         */
        public function __construct(ICarouselRepository $carouselRepo)
        {
            $this->carouselRepo = $carouselRepo;
        }

        public function edit()
        {
			// if has permission then
				$carousel = $this->carouselRepo->getAll();
				return View('carousel.edit', compact('carousel'));
			// else
				// // Totdat er een error page is.
				// return Redirect::route('home.index');
			// end if
        }

        public function update()
        {
			/*
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

                            if(isset($rowItems['rowId']))
                            {
                                $rowId = $rowItems['rowId'];
                                $sideRow = $this->sidebarRepo->get($rowId);

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
			*/
        }
    }