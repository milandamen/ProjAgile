<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
	This class still needs changes: een aangepaste tekst voor in de carousel bij het news item bv.  
*/

class Carousel extends Model {

	protected $table = 'carousel';

	# Primary Key
	protected $primaryKey = 'carouselId';
	protected $guarded = ['carouselId'];


	# Properties that can be changed
	protected $fillable = ['newsId', 'imgpath'];
	
	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;

	#Foreign Keys
	public function news() {
		return $this->belongsTo('App\Models\News', 'foreign_key', 'newsId');
	}
}


?>
