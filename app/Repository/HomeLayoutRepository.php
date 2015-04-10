<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\HomeLayoutModule;

class HomeLayoutRepository extends BaseRepository
{
	public function getAll() {
		$objects = HomeLayoutModule::all();
		$modules = [];
		
		// Order modules
		foreach ($objects as $module) {
			$modules[$module->ordernumber] = $module;
		}
		
		return $modules;
	}
	
	public function get($id) {
		return HomeLayoutModule::find($id);
	}
	
	public function create($attributes = array()) {
		return HomeLayoutModule::create($attributes);
	}
	
}
?>
