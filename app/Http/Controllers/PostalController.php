<?php
namespace App\Http\Controllers;
    use App\Repositories\RepositoryInterfaces\IPostalRepository;
    use App\Repositories\RepositoryInterfaces\IAddressRepository;
    use App\Repositories\RepositoryInterfaces\IHouseNumberRepository;

    class PostalController extends Controller
    {

        public function __construct(IPostalRepository $postalRepo, IAddressRepository $addressRepo,  IHouseNumberRepository $houseNumberRepo)
        {
            $this->postalRepo = $postalRepo;
            $this->addressRepo = $addressRepo;
            $this->houseNumberRepo = $houseNumberRepo;

        }

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            return view('postal.index');
            //return view('page.index', compact('pages'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function upload()
        {

        }
    }