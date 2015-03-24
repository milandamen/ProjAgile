<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\HomeLayoutModule

class HomeLayoutRepository extends BaseRepository
{
	public function getAll() {
		return HomeLayoutModule::all();
	}
	
	public function get($id) {
		return HomeLayoutModule::find($id);
	}
	
	public function create($attributes = array()) {
		return HomeLayoutModule::create($attributes);
	}
	
}
?>
