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
        private $errors = array();

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
                //return view('postal.index');
                $success = true;
                return view('postal.index', compact('success'));
            }
            $success = false;
            $errors = $this->errors;
            return view('postal.index', compact('success', 'errors'));
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
                                    //dd($this->formatId($row->id));
                                    $this->deleteRowInDatabase($row);
                                }
                            }
                        });
                    }
                });
            });
        }

        //Database actions
        protected function addRowToDatabase($row)
        {
            $houseNumber = $this->formatHouseNumber($row->huisnr);
            $suffix = $this->formatSuffix($row->toevoeging);
            $postal = $this->formatPostal($row->postcode);

            $this->addHouseNumber($houseNumber, $suffix);
            $this->addPostal($postal);

            //Create address if not exists
            $districtId = $this->districtRepo->getByName($this->tempSheetName)->districtSectionId;
            $postalId = $this->postalRepo->getByCode($postal)->postalId;
            $houseNumberId = $this->houseNumberRepo->getByHouseNumberSuffix($houseNumber, $suffix)->houseNumberId;

            //dd($districtId, $postalId, $houseNumberId);
            if($this->addressRepo->getByDistrictPostalAndHouseNumber($districtId, $postalId, $houseNumberId) == null)
            {
                $this->addressRepo->create(['districtSectionId' => $districtId, 'postalId' => $postalId, 'houseNumberId' => $houseNumberId]);
            }
            //dd($this->addressRepo->getByDistrictPostalAndHouseNumber($districtId, $postalId, $houseNumberId));

        }

        protected function updateRowInDatabase($row)
        {
            $houseNumber = $this->formatHouseNumber($row->huisnr);
            $suffix = $this->formatSuffix($row->toevoeging);
            $postal = $this->formatPostal($row->postcode);

            $this->addHouseNumber($houseNumber, $suffix);
            $this->addPostal($postal);

            $districtId = $this->districtRepo->getByName($this->tempSheetName)->districtSectionId;
            $houseNumberId = $this->houseNumberRepo->getByHouseNumberSuffix($houseNumber,$suffix)->houseNumberId;
            $postalId = $this->postalRepo->getByCode($postal)->postalId;

            $address = $this->addressRepo->get($this->formatId($row->id));

            $address->districtSectionId = $districtId;
            $address->postalId = $postalId;
            $address->houseNumberId = $houseNumberId;

            $this->addressRepo->update($address);
        }

        protected function deleteRowInDatabase($row)
        {
            $this->addressRepo->destroy($row->id);
        }

        //Adds
        protected function addHouseNumber($houseNumber, $suffix)
        {
            //Create houseNumber if not exists
            if($this->houseNumberRepo->getByHouseNumberSuffix($houseNumber, $suffix) == null)
            {
                $houseNumberCombo = ['houseNumber' => $houseNumber, 'suffix' => $suffix];
                $this->houseNumberRepo->create($houseNumberCombo);
            }
        }

        protected function addPostal($postal)
        {
            //Create postal if not exists
            if($this->postalRepo->getbyCode($postal) == null)
            {
                $postalArray = ['code' => $postal];
                $this->postalRepo->create($postalArray);
            }
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
            $succeed = true;
            $postal     = trim($row->postcode);
            $houseNr    = trim($row->huisnr);
            $suffix     = trim($row->toevoeging);

            if(!empty($suffix))
            {
                if(!$this->validatePostal($postal) || !$this->validateHouseNumber($houseNr) || !$this->validateSuffix($suffix))
                {
                    $succeed =  false;
                }
            }
            else
            {
                if(!$this->validatePostal($postal) || !$this->validateHouseNumber($houseNr))
                {
                    $succeed = false;
                }
            }

            if(!$succeed)
            {
                $errorMessage = 'Werkblad: ' . $this->tempSheetName . ' Rij: ' . $this->formatId($row->id) . ' is foutief';
                if(!in_array($errorMessage,$this->errors)) {
                    array_push($this->errors, 'Werkblad: ' . $this->tempSheetName . ' Rij: ' . $this->formatId($row->id) . ' is foutief');
                }
            }
            return $succeed;
        }

        protected function validatePostal($postal)
        {
            if(strlen($postal) != 6 && strlen($postal) != 7)
            {
                return false;
            }
            else
            {
                if(!ctype_alnum(substr($postal,0,4)) || !is_numeric(substr($postal,0,4)))
                {
                    return false;
                }
                else
                {
                    if(!ctype_alpha(substr($postal,-2,2)))
                    {
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