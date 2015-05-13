<?php
	namespace App\Http\Controllers;

	class ManagementController extends Controller
	{
		/**
		 * Display the management menu.
		 *
		 * @return Response
		 */
		public function index()
		{
			return view('management.index');
		}
	}