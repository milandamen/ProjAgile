<?php
namespace App\Http\Controllers;

    use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
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
        private $districts = array();
        private $validationResults = array();
        private $tempSheetName;

        private $willDeleteActions = array();

        /**
         * Creates a new PostalController instance.
         *
         * @param IPostalRepository 	    $postalRepo
         * @param IAddressRepository        $addressRepo
         * @param IHouseNumberRepository    $houseNumberRepo
         *
         */
        public function __construct(IPostalRepository $postalRepo, IAddressRepository $addressRepo,  IHouseNumberRepository $houseNumberRepo, IDistrictSectionRepository $districtRepo)
        {
            $this->postalRepo = $postalRepo;
            $this->addressRepo = $addressRepo;
            $this->houseNumberRepo = $houseNumberRepo;
            $this->districtRepo = $districtRepo;

            $this->districtRepo->getAll()->each(function ($district)
            {
                if($district->name != 'Home')
                {
                    array_push($this->districts, $district->name);
                }
            });
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

            //TODO:: Mimetype check


            Excel::load($file, function($reader)
            {
                //Loop through all sheets
                $reader->toObject()->each(function($sheet)
                {

                    if(in_array($sheet->getTitle(), $this->districts))
                    {
                        $this->tempSheetName = $sheet->getTitle();
                        // Loop through all rows
                        $sheet->each(function ($row)
                        {
                            if(!empty($row->postcode) && !empty($row->huisnr))
                            {
                                if(!$this->validateRow($row))
                                {
                                    array_push($this->validationResults, ['Sheet' => $this->tempSheetName, 'Id' => trim($row->id), 'Postcode' => trim($row->postcode), 'HuisNr' => trim($row->huisnr), 'Toevoeging' => trim($row->toevoeging), 'Geslaagd' => $this->validateRow($row)]);
                                }
                            }
                        });
                    }
                });
            });
            if(count($this->validationResults) != 0)
            {
                return false;
            }
            return true;

        }

        public function uploadFile($file)
        {
            Excel::load($file, function($reader)
            {
                //Loop through all sheets
                $reader->toObject()->each(function($sheet)
                {

                    if(in_array($sheet->getTitle(), $this->districts))
                    {
                        $this->tempSheetName = $sheet->getTitle();
                        // Loop through all rows
                        $sheet->each(function ($row)
                        {
                            if(!empty($row->postcode) && !empty($row->huisnr))
                            {
                                if (!isset($row->id) || empty($row->id))
                                {
                                    $this->addRowToDatabase($row);
                                }
                                else
                                {
                                    $this->updateRowInDatabase($row);
                                }
                            }
                            else
                            {
                                if ($this->formatId($row->id) != 0)
                                {
                                    $this->deleteRowInDatabase($row);
                                }
                            }
                        });
                        //dd($this->willDeleteActions);
                    }
                });
            });
        }

        //Database actions
        protected function addRowToDatabase($row)
        {
            array_push($this->willDeleteActions, array($this->formatId($row->id), $row->postcode, $row->huisnr, $row->toevoeging, 'Add'));

            $houseNumber = $this->formatHouseNumber($row->huisnr);
            $suffix = $this->formatSuffix($row->toevoeging);

            //Create houseNumber if not exists
            if($this->houseNumberRepo->getByHouseNumberSuffix($houseNumber, $suffix) == null)
            {
                $houseNumberCombo = ['houseNumber' => $houseNumber, 'suffix' => $suffix];
                $this->houseNumberRepo->create($houseNumberCombo);
            }
        }

        protected function updateRowInDatabase($row)
        {
            array_push($this->willDeleteActions, array($this->formatId($row->id), $row->postcode, $row->huisnr, $row->toevoeging, 'Update'));
        }

        protected function deleteRowInDatabase($row)
        {
            array_push($this->willDeleteActions, array($this->formatId($row->id), $row->postcode, $row->huisnr, $row->toevoeging, 'Delete'));
        }


        //Formatters
        protected function formatId($Id)
        {
            return intval($Id);
        }

        protected function formatPostal($postal)
        {
            return strtoupper(substr(trim($postal), 0, 4) . ' ' . substr(trim($postal), -2, 2));
        }

        protected function formatHouseNumber($houseNumber)
        {
            return intval($houseNumber);
        }

        protected function formatSuffix($suffix)
        {
            $trimmedSuffix = trim($suffix);
            if(empty($trimmedSuffix) || !isset($trimmedSuffix))
            {
                return null;
            }
            return strtoupper($trimmedSuffix);
        }

        //Validators
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
                //dd('lengte = ' . strlen($postal) . 'postcode = ' . $postal);
                return false;
            }
            else
            {
                if(!ctype_alnum(substr($postal,0,4)) || !is_numeric(substr($postal,0,4)))
                {
                    //dd('niet numeriek ' . $postal . ' checken op: ' . substr($postal,0,4));
                    return false;
                }
                else
                {
                    if(!ctype_alpha(substr($postal,-2,2)))
                    {
                        //dd('niet letter ' . $postal);
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