<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class HomeLayoutModule extends Model 
	{
	    /**
	     * Table name.
	     * 
	     * @var string
	     */
		protected $table = 'homelayout';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
		protected $primaryKey = 'homeLayoutId';

        /**
         * Laravel's automatic timestamps convention.
         * 
         * @var bool
         */
		public $timestamps = false;

        /**
         * Attributes that can be changed and thus are mass assingable.
         * 
         * @var array
         */
		protected $fillable = 
		[
			'moduleName',
			'ordernumber'
		];

        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array
         */
		protected $guarded = 
		[
			'homeLayoutId'
		];
	}