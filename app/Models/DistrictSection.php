<?php
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class DistrictSection extends Model 
	{
		/**
		 * Table name.
		 * 
		 * @var string
		 */
		protected $table = 'districtsection';

		/**
		 * PrimaryKey name.
		 * 
		 * @var string
		 */
		protected $primaryKey = 'districtSectionId';

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
			'name', 
			'generalInfo'
		];
		
		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 * 
		 * @var array
		 */
		protected $guarded = 
		[
			'districtSectionId'
		];

		/**
		 * Get all Address models that reference this DistrictSection model.
		 * 
		 * @return Collection -> Address
		 */
		public function address() 
		{
			return $this->hasMany('App\Models\Address', 'districtSectionId');
		}

		/**
		* Get all News models that reference this DistrictSection model.
		*
		* @return Collection -> News
		*/
		public function news()
		{
			return $this->belongsToMany('News', 'newsdistrictsection', 'districtSectionId', 'newsId');
		}

		/**
		* Get all User models that reference this DistrictSection model.
		*
		* @return Collection -> User
		*/
		public function districtSectionPermissions()
		{
			return $this->belongsToMany('Address', 'districtSectionpermissions', 'districtSectionId', 'userId');
		}
	}