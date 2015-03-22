<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Districtsection

class DistrictSectionRepository extends BaseRepository
{
	public function getAll() {
		return Districtsection::all();
	}
	
	public function get($id) {
		return Districtsection::find($id);
	}
	
	public function create($attributes = array()) {
		return Districtsection::create($attributes);
	}
	
}
?>
