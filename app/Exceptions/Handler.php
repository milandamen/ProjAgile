<?php 
	namespace App\Exceptions;

	use Exception;
	use Flash;
	use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
	use Illuminate\Session\TokenMismatchException;
	use Redirect;
	use Session;

	class Handler extends ExceptionHandler 
	{
		/**
		 * A list of the exception types that should not be reported.
		 *
		 * @var array
		 */
		protected $dontReport = 
		[
			'Symfony\Component\HttpKernel\Exception\HttpException'
		];

		/**
		 * Report or log an exception.
		 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
		 *
		 * @param  \Exception  $e
		 * 
		 * @return void
		 */
		public function report(Exception $e)
		{
			return parent::report($e);
		}

		/**
		 * Render an exception into an HTTP response.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  \Exception  $e
		 * 
		 * @return \Illuminate\Http\Response
		 */
		public function render($request, Exception $e)
		{
			if (!config('app.debug') && !$this->isHttpException($e)) 
			{
				if ($e instanceof \PDOException)
				{
					return response()->view('errors.database');
				}

				return response()->view('errors.500');
			}

			if ($e instanceof TokenMismatchException)
			{
				return Redirect::back()->withErrors(['Wegens beveiligingsredenen is uw formulier verlopen. Probeer het alstublieft opnieuw.']);
			}
			
			return parent::render($request, $e);
		}
	}