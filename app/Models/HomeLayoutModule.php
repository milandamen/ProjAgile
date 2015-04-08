<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class HomeLayoutModule extends Model 
	{
	    /**
	     * Table name
	     * 
	     * @var string
	     */
		protected $table = 'homelayout';

        /**
         * PrimaryKey name
         * 
         * @var string
         */
		protected $primaryKey = 'modulename';

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
			'ordernumber'
		];

        /**
         * Attributes that cannot be changed and thus are not mass assingable
         * 
         * @var array()
         */
		protected $guarded = 
		[
			'modulename'
		];
	}