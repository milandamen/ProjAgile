<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Introduction;

class IntroductionRepository extends BaseRepository
{
    public function getAll() {
		return Introduction::all();
	}
	
	public function get($id) {
		return Introduction::find($id);
	}

	public function getPageBar($pageId){
		return Introduction::where('pageId', '=', $pageId);
	}

	public function create($attributes = array()) {
		return Introduction::create($attributes);
	}
    
}
?>
