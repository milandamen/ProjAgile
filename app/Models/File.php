<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

	protected $table = 'file';

	# Primary Key
	protected $primaryKey = 'fileId';
	protected $guarded = ['fileId'];

	# Properties that can be changed
	protected $fillable = ['newsId', 'path'];
	
	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;

	#Foreign Keys
	public function news() {
		return $this->belongsTo('App\Models\News', 'foreign_key', 'newsId');
	}
}


?>
