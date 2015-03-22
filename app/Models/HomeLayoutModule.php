<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeLayoutModule extends Model {

	protected $table = 'homelayout';

	# Primary Key
	protected $guarded = ['module-name'];

	# Properties that can be changed
	protected $fillable = ['ordernumber'];

	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;


}


?>
