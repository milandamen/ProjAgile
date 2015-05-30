<?php
namespace App\Http\Controllers;
    use App\Repositories\RepositoryInterfaces\IPostalRepository;
    use App\Repositories\RepositoryInterfaces\IAddressRepository;
    use App\Repositories\RepositoryInterfaces\IHouseNumberRepository;

    class PostalController extends Controller
    {
        /**
         * Creates a new PostalController instance.
         *
         * @param IPostalRepository 	    $postalRepo
         * @param IAddressRepository        $addressRepo
         * @param IHouseNumberRepository    $houseNumberRepo
         *
         * @return void
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

        }
    }