<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Introduction extends Model {

	protected $table = 'introduction';

	# Primary Key
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

	# Properties that can be changed
	protected $fillable = ['pageId', 'title', 'text'];
	
	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;


}


?>
