<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
 Volgens mij moet dit model nog aangepast worden naar een model met een : publicatie datum, verdwijndatum en lijst-nummer (om omhoog te shoppen in de lijst).

*/

class News extends Model {

	protected $table = 'news';

	# Primary Key
	protected $primaryKey = 'newsId';
	protected $guarded = ['newsId'];

	# Properties that can be changed
	protected $fillable = ['districtSectionId', 'userId', 'title', 'content', 'date', 'hidden'];

	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;


	# Foreign keys

	# Keys used in news
	public function district() {
		return $this->belongsTo('App\Models\DistrictSection', 'foreign_key');
	}

	public function user() {
		return $this->belongsTo('App\Models\User', 'foreign_key');
	}

	# Key newsId used elsewhere
	public function files() {
		return $this->hasMany('App\Models\File', 'foreign_key', 'newsId');
	}

	public function carousel() {
		return $this->hasMany('App\Models\Carousel', 'foreign_key', 'newsId');
	}


}


?>
