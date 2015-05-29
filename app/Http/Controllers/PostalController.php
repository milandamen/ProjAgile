<?php
    namespace App\Http\Controllers;

    //use App\Http\Controllers\Controller;
    use App\Repositories\RepositoryInterfaces\IPostalRepository;
    use View;

    class PostalController extends Controller
    {
        /**
         * The PostalRepository implementation.
         *
         * @var IPostalRepository
         */
        private $postalRepo;
        private $bundersPostals = array();
        private $larenPostals = array();
        private $donkenPostals = array();
        private $weiden = array();
        private $velden = array();
        private $columns = array('Straatnaam','Postcode','Huisnummer','Toevoeging');

        public function __construct(IPostalRepository $postalRepo)
        {
            $this->postalRepo = $postalRepo;
        }

        /**
         * Show the postal managing panel
         *
         * @return Response
         */
        public function index()
        {
            return view('postal.index');
        }

        public function readExcel()
        {
            $excelFile = $_POST['file'];

            Excel::load($excelFile, function($reader)
            {
                $reader->each(function($sheet){
                   switch($sheet)
                   {
                       case 'bunders':
                           $sheet->each(function($row)
                           {
                               array_push($this->bundersPostals,$row->toObject());
                           });
                           break;
                       case 'laren':
                           $sheet->each(function($row)
                           {
                               array_push($this->larenPostals,$row->toObject());
                           });
                           break;
                       case 'donken':
                           $sheet->each(function($row)
                           {
                               array_push($this->donkenPostals,$row->toObject());
                           });
                           break;
                       case 'wijden':
                           $sheet->each(function($row)
                           {
                               array_push($this->weidenPostals,$row->toObject());
                           });
                           break;
                       case 'velden':
                           $sheet->each(function($row)
                           {
                               array_push($this->veldenPostals,$row->toObject());
                           });
                           break;
                   }
                });
            });

        }

        private function validateFileStructure($excelFile)
        {
            $passed = true;
            Excel::load($excelFile, function($reader)
            {
                //Check for each sheet
                $reader->each(function ($sheet) {
                    //Check columns of eacht first row (Header)
                    $sheet[0]->each(function ($column){
                        if(!in_array($column, $this->columns))
                        {
                            $passed = false;
                        }
                    });
                });
            });
            return $passed;
        }

        private function validatePostal($postal)
        {
            $postalLength = count(trim($postal));

            if($postalLength != 6 && $postalLength != 7)
            {
                return false;
            }
            else
            {
                if(is_numeric(substr($postal, 0,4)) && ctype_alpha(substr($postal, -2)))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }

        private function validateHouseNumber($housnumber)
        {
            if(is_numeric($housnumber))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        private function validateNumberSuffix($numberSuffix)
        {
            if(ctype_alpha($numberSuffix) && count($numberSuffix) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }






