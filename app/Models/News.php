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

    //needs to be changed
	public function carousel() {
		return $this->hasMany('App\Models\Carousel', 'newsId');
	}

    public function newscomments() {
        return $this->hasMany('App\Models\Newscomment', 'newsId');
    }
	
	/**
	 * Get the date of this news item, in a d-m-Y format (so without the time).
	 * In order to call this, call $newsItem->normalDate()  and NOT $newsItem->normalDate
	 */
	public function normalDate() {
		$date = date_create($this->date);
		return date_format($date,'d-m-Y') ;
	}

}


?>
