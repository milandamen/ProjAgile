<?php
namespace App\Http\Controllers;
    class PostalController extends Controller
    {



        public function __construct()
        {

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