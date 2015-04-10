<?php
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Districtsection extends Model 
	{
	    /**
	     * Table name.
	     * 
	     * @var string
	     */
		protected $table = 'districtSection';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
		protected $primaryKey = 'districtSectionId';

        /**
         * Laravel's automatic timestamps convention.
         * 
         * @var boolean
         */
		public $timestamps = false;

        /**
         * Attributes that can be changed and thus are mass assingable.
         * 
         * @var array()
         */
		protected $fillable = 
		[
			'name', 
			'generalInfo'
		];
		
        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array()
         */
		protected $guarded = 
		[
			'districtSectionId'
		];

		/**
		 * Get all Activity models that reference this DistrictSection model.
		 * 
		 * @return Collection -> Activity
		 */
		public function activities() 
		{
			return $this->hasMany('App\Models\Activity', 'foreign_key', 'districtSectionId');
		}

		/**
		 * Get all Contact models that reference this DistrictSection model.
		 * 
		 * @return Collection -> Contact
		 */
		public function contacts() 
		{
			return $this->hasMany('App\Models\Contact', 'foreign_key', 'districtSectionId');
		}

		/**
		 * Get all News models that reference this DistrictSection model.
		 * 
		 * @return Collection -> News
		 */
		public function news() 
		{
			return $this->hasMany('App\Models\News', 'foreign_key', 'districtSectionId');
		}

		/**
		 * Get all Project models that reference this DistrictSection model.
		 * 
		 * @return Collection -> Project
		 */
		public function projects() 
		{
			return $this->hasMany('App\Models\Project', 'foreign_key', 'districtSectionId');
		}

		/**
		 * Get all User models that reference this DistrictSection model.
		 * 
		 * @return Collection -> User
		 */
		public function users() 
		{
			return $this->hasMany('App\Models\User', 'foreign_key', 'districtSectionId');
		}
	}