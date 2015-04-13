<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Districtsection;

class DistrictsectionRepository extends BaseRepository
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

    public function getAllToList()
    {
        return Districtsection::all()->lists('name','districtSectionId');
    }
}
?>
