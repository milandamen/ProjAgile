<?php 
	namespace App\Http\Controllers;

	use Illuminate\Contracts\Routing\ResponseFactory;

	class FileController extends Controller
	{
		/**
		 * Create a new controller instance.
		 *
		 * @return void
		 */
		public function __construct(ResponseFactory $responseFactory) 
		{
			$this->responseFactory = $responseFactory;
		}
		
		// 
		/**
		 * For this function to work, enable "extension=php_fileinfo.dll" in php.ini.
		 * 
		 * @param  string $filename
		 * 
		 * @return Response
		 */
		public function getDownload($fileName)
		{
			// Check if file exists in app/public/uploads folder
			$file_path = public_path() . '/uploads/' . $fileName;

			if (file_exists($file_path))
			{
				// Send Download
				return $this->responseFactory->download($file_path, $fileName, 
				[
					'Content-Length: '. filesize($file_path)
				]);
			}
			else
			{
				// If file does not exist, throw error
				exit('Bestand niet gevonden');
			}
		}
	}