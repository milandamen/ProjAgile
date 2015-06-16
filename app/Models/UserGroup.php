<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class UserGroup extends Model 
	{
		/**
		 * Table name.
		 * 
		 * @var string
		 */
		protected $table = 'usergroup';

		/**
		 * PrimaryKey name.
		 * 
		 * @var string
		 */
		protected $primaryKey = 'userGroupId';

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
			'name'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 * 
		 * @var array
		 */
		protected $guarded = 
		[
			'userGroupId'
		];

		/**
		 * Get all User models that reference this UserGroup model.
		 * 
		 * @return Collection -> User
		 */
		public function users()
		{
			return $this->hasMany('App\Models\User', 'userGroupId');
		}

		/**
		 * Get all DistrictSection models that reference this UserGroup model (permissions).
		 *
		 * @return Collection -> DistrictSection
		 */
		public function districtSections()
		{
			return $this->belongsToMany('App\Models\DistrictSection', 'usergroupdistrictsectionpermissions', 'userGroupId', 'districtSectionId');
		}

		/**
		 * Get all Page models that reference this UserGroup model (permissions).
		 *
		 * @return Collection -> Page
		 */
		public function pages()
		{
			return $this->belongsToMany('App\Models\Page', 'usergrouppagepermissions', 'userGroupId', 'pageId');
		}

		/**
		 * Get all Permission models that reference this UserGroup model (permissions).
		 *
		 * @return Collection -> Permission
		 */
		public function permissions()
		{
			return $this->belongsToMany('App\Models\Permission', 'usergrouppermissions', 'userGroupId', 'permissionId');
		}

		/**
		 * Check if the usergroup has permission to edit the given page
		 *
		 * @param $pageId
		 * @return Boolean
		 */
		public function hasPagePermission($pageId)
		{
			return $this->pages->contains($pageId);
		}

		/**
		 * Check if the usergroup has permission to edit news from the given districtSection.
		 *
		 * @param $districtSectionId
		 * @return Boolean
		 */
		public function hasDistrictSectionPermission($districtSectionId)
		{
			return $this->districtSections->contains($districtSectionId);
		}

		/**
		 * Check if the usergroup has the given permission
		 *
		 * @param $permissionId
		 * @return Boolean
		 */
		public function hasPermission($permissionId)
		{
			return $this->permissions->contains($permissionId);
		}
	}