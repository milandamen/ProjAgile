<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model {

	protected $table = 'usergroup';

	# Primary Key   (Geen standaardwaarde, noch auto-increment)
	protected $primaryKey = 'userGroupId';
	#protected $guarded = ['userGroupId'];

	# Properties that can be changed
	protected $fillable = ['userGroupId', 'name'];
	
	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;

	# Foreign Keys
	public function users(){
		return $this->hasMany('App\Models\User', 'foreign_key', 'userGroupId');
	}

}


?>
