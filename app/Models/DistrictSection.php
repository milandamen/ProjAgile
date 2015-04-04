<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Districtsection extends Model {

	protected $table = 'districtsection';

	# Primary Key
//	protected $guarded = ['districtSectionId'];  // Geen Auto-increment?
	protected $primaryKey = 'districtsectionId';

	# Properties that can be changed
	protected $fillable = ['districtsectionId', 'name', 'generalInfo'];
	
	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;

	public function news() {
		return $this->hasMany('App\Models\News', 'newsId');
	}

	public function users(){
		return $this->hasMany('App\Models\User', 'foreign_key', 'districtsectionId');
	}

}


?>
