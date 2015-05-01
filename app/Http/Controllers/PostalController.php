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

    }