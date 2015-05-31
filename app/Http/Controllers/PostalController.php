<?php
namespace App\Http\Controllers;

    use App\Repositories\RepositoryInterfaces\IPostalRepository;
    use App\Repositories\RepositoryInterfaces\IAddressRepository;
    use App\Repositories\RepositoryInterfaces\IHouseNumberRepository;
    use Request;
    use Input;
    use Excel;

    class PostalController extends Controller
    {
        private $postalRepo;
        private $addressRepo;
        private $houseNumberRepo;
        private $districts = array('De Bunders en De Weiden','De Donken','De Laren');
        private $validationResults = array();

        /**
         * Creates a new PostalController instance.
         *
         * @param IPostalRepository 	    $postalRepo
         * @param IAddressRepository        $addressRepo
         * @param IHouseNumberRepository    $houseNumberRepo
         *
         */
        public function __construct(IPostalRepository $postalRepo, IAddressRepository $addressRepo,  IHouseNumberRepository $houseNumberRepo)
        {
            $this->postalRepo = $postalRepo;
            $this->addressRepo = $addressRepo;
            $this->houseNumberRepo = $houseNumberRepo;
        }

        /**
         * Display the postal management page.
         *
         * @return Response
         */
        public function index()
        {
            return view('postal.index');
            //return view('page.index', compact('pages'));
        }

        /**
         * Function for uploading the new postal information.
         *
         * @return Response
         */
        public function upload()
        {
            $file = Request::file('Excel');
            if($this->validateFile($file))
            {
                $this->uploadFile($file);
            }
        }

        public function validateFile($file)
        {
//            if($file->mimetype != 'application/vnd.ms-excel')
//            {
//                return false();
//            }
            Excel::load($file, function($reader)
            {
                //Loop through all sheets
                $reader->toObject()->each(function($sheet)
                {

                    if(in_array($sheet->getTitle(), $this->districts))
                    {
                        // Loop through all rows
                        $sheet->each(function ($row)
                        {
                            if(!empty($row->postcode) && !empty($row->huisnr))
                            {
                                $this->validateRow($row);
                                array_push($this->validationResults , ['Id' => trim($row->Id), 'Postcode' => trim($row->postcode), 'HuisNr' => trim($row->huisnr), 'Toevoeging' => trim($row->toevoeging), 'Geslaagd' => $this->validateRow($row)]);
                                //$this->validateRow($row);
                            }
                        });
                    }
                    dd($this->validationResults);

                });

            });
            return true;
        }

        public function uploadFile($file)
        {

        }

        protected function validateRow($row)
        {
            $postal     = trim($row->postcode);
            $houseNr    = trim($row->huisnr);
            $suffix     = trim($row->toevoeging);

            if(!empty($suffix))
            {
                if(!$this->validatePostal($postal) || !$this->validateHouseNumber($houseNr) || !$this->validateSuffix($suffix))
                {
                    return false;
                }
            }
            else
            {
                if(!$this->validatePostal($postal) || !$this->validateHouseNumber($houseNr))
                {
                    return false;
                }
            }
            return true;
        }

        protected function validatePostal($postal)
        {
            if(strlen($postal) != 6 && strlen($postal) != 7)
            {
                dd('lengte = ' . strlen($postal) . 'postcode = ' . $postal);
                return false;
            }
            else
            {
                if(!ctype_alnum(substr($postal,0,4)) || !is_numeric(substr($postal,0,4)))
                {
                    dd('niet numeriek ' . $postal . ' checken op: ' . substr($postal,0,4));
                    return false;
                }
                else
                {
                    if(!ctype_alpha(substr($postal,-2,2)))
                    {
                        dd('niet letter ' . $postal);
                        return false;
                    }
                }
            }
            return true;
        }

        protected function validateHouseNumber($houseNumber)
        {
            if(!ctype_alnum($houseNumber) || !is_numeric($houseNumber))
            {
                return false;
            }
            return true;
        }

        protected function validateSuffix($suffix)
        {
            if(strlen($suffix) != 1 || !ctype_alpha($suffix))
            {
                return false;
            }
            return true;
        }
    }