<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistrictSection extends Model {

	protected $table = 'districtsection';

	# Primary Key
//	protected $guarded = ['districtSectionId'];  // Geen Auto-increment?

	# Properties that can be changed
	protected $fillable = ['districtSectionId', 'name', 'generalInfo'];
	
	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;

	public function news() {
		return $this->hasMany('App\Models\News', 'foreign_key', 'districtSectionId');
	}

	public function users(){
		return $this->hasMany('App\Models\User', 'foreign_key', 'districtSectionId');
	}

}


?>
