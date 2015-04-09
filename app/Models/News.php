<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
 Volgens mij moet dit model nog aangepast worden naar een model met een : publicatie datum, verdwijndatum en lijst-nummer (om omhoog te shoppen in de lijst).

dit doe je in de database.

*/

class News extends Model {

	protected $table = 'news';

	# Primary Key
	protected $primaryKey = 'newsId';
	protected $guarded = ['newsId'];

	# Properties that can be changed
	protected $fillable = ['districtsectionId', 'userId', 'title', 'content', 'date', 'hidden', 'comments'];

	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;


	# Foreign keys

	# Keys used in news
	public function district() {
		return $this->belongsTo('App\Models\Districtsection', 'districtsectionId');
	}

	public function user() {
        return $this->belongsTo('App\Models\User', 'userId');
	}

	# Key newsId used elsewhere
	public function files() {
		return $this->hasMany('App\Models\File', 'fileId');
	}

	public function carousel() {
		return $this->hasMany('App\Models\Carousel', 'foreign_key', 'newsId');
	}


}


?>
