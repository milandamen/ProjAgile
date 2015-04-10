<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model {

	protected $table = 'footer';

	# Primary key
	protected $guard = ['footerId'];

	# Properties that can be changed
	protected $fillable = ['col', 'row', 'text', 'link'];

	# Laravel's automatic timestamps (like updated_at) 
	public $timestamps = false;

}

?>
