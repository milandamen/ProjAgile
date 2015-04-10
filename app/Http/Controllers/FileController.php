<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;

class FileController extends Controller
{
	
	public function __construct(ResponseFactory $responseFactory) {
		$this->responseFactory = $responseFactory;
	}
	
	// For this function to work, enable "extension=php_fileinfo.dll" in php.ini
	public function getDownload($filename)
	{
		// Check if file exists in app/public/uploads folder
		$file_path = public_path() .'/uploads/'. $filename;
		if (file_exists($file_path))
		{
			// Send Download
			return $this->responseFactory->download($file_path, $filename, [
				'Content-Length: '. filesize($file_path)
			]);
		}
		else
		{
			//If file does not exist, throw error
			exit('Bestand niet gevonden');
		}
	}
}