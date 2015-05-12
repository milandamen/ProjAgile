<?php
	namespace App\Http\Controllers;

	class AdminController extends Controller
	{
		/**
		 * Display the administrator menu.
		 *
		 * @return Response
		 */
		public function index()
		{
			return view('admin.index');
		}
	}