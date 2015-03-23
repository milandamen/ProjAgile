<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\News;

class NewsRepository extends BaseRepository
{
	public function getAll() {
		return News::all();
	}
	
	public function get($id) {
		return News::find($id);
	}
	
	public function create($attributes = array()) {
		return News::create($attributes);
	}

	public function getByTitle($term) {
		$term = '%'.$term.'%';
		return News::where('title', 'LIKE', $term)->where('hidden', '=', 0)->get();
	}

}
?>
