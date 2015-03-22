<?php
namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\User

class UserRepository extends BaseRepository
{
	public function getAll() {
		return User::all();
	}
	
	public function get($id) {
		return User::find($id);
	}
	
	public function create($attributes = array()) {
		return User::create($attributes);
	}

	public function getByUsername($username)
	{
		return User::where('username', 'LIKE', $term)->get();
	}

}
?>
