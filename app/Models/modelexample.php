<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class modelexample extends Model {

	protected $table = '';

	# Primary Key
	protected $primaryKey = '';
	protected $guarded = [''];

	# Properties that can be changed
	protected $fillable = [''];
	
	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;


}


?>
