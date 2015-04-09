<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// DUBBELE NAAMGEVING!!! Zal gaan conflicten met de user.php van laravel zelf.

class User extends Model {

	protected $table = 'user';

	# Primary Key
	protected $primaryKey = 'userId';
	protected $guarded = ['userId'];

	# Properties that can be changed
	protected $fillable = ['userGroupId', 'districtSectionId', 'username', 'password', 'salt', 'firstName', 'surname', 'postal', 'houseNumber', 'email', 'active'];
	
	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;

	# Foreign Keys
	#used in this table
	public function district() {
		return $this->belongsTo('App\Models\District', 'foreign_key');
	}

	public function usergroup(){
		return $this->belongsTo('App\Models\UserGroup', 'foreign_key');
	}

	public function news(){
        return $this->hasMany('App\Models\News', 'newsId');
	}

    public function newscomments(){
        return $this->hasMany('App\Models\Newscomment', 'newscommentId');
    }

}


?>
