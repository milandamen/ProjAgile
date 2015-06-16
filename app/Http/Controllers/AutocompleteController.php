<?php 
	namespace App\Http\Controllers;

	use App\Models\Menu;
	use App\Models\Page;
	use App\Models\DistrictSection;
	use App\Models\User;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use Illuminate\Routing\Controller;
	use Input;

	class AutocompleteController extends Controller
	{
		/**
		 * The PageRepository implementation.
		 * 
		 * @var IPageRepository
		 */
		private $pageRepo;

		/**
		 * Creates a new AutocompleteController instance.
		 * 
		 * @param  IPageRepository	$pageRepo
		 *
		 * @return void
		 */
		public function __construct(IPageRepository $pageRepo, IDistrictSectionRepository $districtRepo)
		{
			$this->pageRepo = $pageRepo;
			$this->districtRepo = $districtRepo;
		}

		/**
		 * Provide autocomplete results requested via an Ajax call.
		 * 
		 * @return JSON
		 */
		public function autocomplete()
		{
			// Prevent direct access (check if ajax request).
			$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

			if(!$isAjax) 
			{
				$user_error = 'Access denied - not an AJAX request...';
				trigger_error($user_error, E_USER_ERROR);
			}

			// Get what user typed in autocomplete input.
			$term = trim(Input::get('term'));

			$a_json = array();
			$a_json_row = array();

			// Replace multiple spaces with one.
			$term = preg_replace('/\s+/', ' ', $term);

			$items = $this->pageRepo->getAllLikeTerm($term);

			foreach($items as $item)
			{
				$a_json_row["label"] = $item->introduction->title;
				$a_json_row["value"] = '/pagina/' . $item->pageId;
				array_push($a_json, $a_json_row);
			}

			$districts = $this->districtRepo->getAllLikeTerm($term);

			foreach($districts as $item)
			{
				$a_json_row["label"] = $item->name;
				$a_json_row["value"] = '/deelwijk/' . $item->name;
				array_push($a_json, $a_json_row);
			}


			$json = json_encode($a_json);
			print $json;
		}

		/**
		 * Provide autocomplete user results requested via an Ajax call.
		 * 
		 * @return JSON
		 */
		public function userAutocomplete()
		{
			// Prevent direct access (check if ajax request).
			$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

			if(!$isAjax) 
			{
				$user_error = 'Access denied - not an AJAX request...';
				trigger_error($user_error, E_USER_ERROR);
			}

			// Get what the user typed in autocomplete input.
			$term = trim(Input::get('term'));

			$a_json = array();
			$a_json_row = array();

			// Replace multiple spaces with one.
			$term = preg_replace('/\s+/', ' ', $term);

			$items = User::where('username', 'LIKE', '%' . $term . '%')->get();

			foreach($items as $item)
			{
				$a_json_row["label"] = $item->username;
				$a_json_row["value"] = $item->username;
				array_push($a_json, $a_json_row);
			}

			$json = json_encode($a_json);
			print $json;
		}
	}