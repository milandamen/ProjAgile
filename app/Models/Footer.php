<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Footer extends Model 
	{
	    /**
	     * Table name
	     * 
	     * @var string
	     */
		protected $table = 'footer';

        /**
         * Laravel's automatic timestamps convention
         * 
         * @var boolean
         */
		public $timestamps = false;

        /**
         * Attributes that can be changed and thus are mass assingable
         * 
         * @var array()
         */
		protected $fillable = 
		[
			'col', 
			'row', 
			'text', 
			'link'
		];
	}