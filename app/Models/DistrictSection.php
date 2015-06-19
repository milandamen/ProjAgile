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
			return $this->belongsToMany('App\Models\News', 'newsdistrictsection', 'districtSectionId', 'newsId');
		}
		
		/**
		* Get all Page models that reference this DistrictSection model.
		*
		* @return Collection -> Page
		*/
		public function pages()
		{
			return $this->belongsToMany('App\Models\Page', 'districtsection_has_page', 'districtsection_districtSectionId', 'page_pageId');
		}

		/**
		* Get all User models that reference this DistrictSection model.
		*
		* @return Collection -> User
		*/
		public function districtSectionPermissions()
		{
			return $this->belongsToMany('App\Models\Address', 'districtsectionpermissions', 'districtSectionId', 'userId');
		}

		/**
		 * Get all User models that reference this DistrictSection model (permissions).
		 *
		 * @return Collection -> DistrictSection
		 */
		public function users()
		{
			return $this->belongsToMany('App\Models\User', 'districtsectionpermissions', 'districtSectionId', 'userId');
		}

		public function usersView()
		{
			return $this->belongsToMany('App\Models\User', 'districtsectionviewpermissions', 'districtSectionId', 'userGroupId');
		}

		public function groups()
		{
			return $this->belongsToMany('App\Models\UserGroup', 'usergroupdistrictsectionpermissions', 'districtSectionId', 'userGroupId');
		}

		public function groupsView()
		{
			return $this->belongsToMany('App\Models\UserGroup', 'usergroupdistrictsectionpermissions', 'districtSectionId', 'userGroupId');
		}

	}