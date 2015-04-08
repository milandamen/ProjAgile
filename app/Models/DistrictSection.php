<?php
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Districtsection extends Model 
	{
	    /**
	     * Table name
	     * 
	     * @var string
	     */
		protected $table = 'districtsection';

        /**
         * PrimaryKey name
         * 
         * @var string
         */
		protected $primaryKey = 'districtsectionId';

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
			'name', 
			'generalInfo'
		];
		
        /**
         * Attributes that cannot be changed and thus are not mass assingable
         * 
         * @var array()
         */
		protected $guarded = 
		[
			'districtsectionId'
		];

		/**
		 * Get all News models that reference this Districtsection model
		 * 
		 * @return Collection -> News
		 */
		public function news() 
		{
			return $this->hasMany('App\Models\News', 'newsId');
		}

		/**
		 * Get all User models that reference this Districtsection model
		 * 
		 * @return Collection -> User
		 */
		public function users()
		{
			return $this->hasMany('App\Models\User', 'foreign_key', 'districtsectionId');
		}
	}