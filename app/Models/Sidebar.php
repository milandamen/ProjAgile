<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model {

	protected $table = 'sidebar';

	# Primary Key
	protected $guarded = ['id'];

	# Properties that can be changed
	protected $fillable = ['pageNr','rowNr', 'title', 'text', 'internlink', 'externlink'];
	
	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;


}


?>
