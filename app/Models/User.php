<?php 
	namespace App\Models;

	use Illuminate\Auth\Authenticatable;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Auth\Passwords\CanResetPassword;
	use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
	use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

	class User extends Model implements AuthenticatableContract, CanResetPasswordContract
	{	
		use Authenticatable, CanResetPassword;

		/**
		 * Table name.
		 * 
		 * @var string
		 */
		protected $table = 'user';

		/**
		 * PrimaryKey name.
		 * 
		 * @var string
		 */
		protected $primaryKey = 'userId';

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
			'userGroupId',
			'addressId',
			'postalId',
			'username',
			'firstName',
			'insertion',
			'surname',
			'password',
			'email', 
			'active',
			'remember_Token'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 * 
		 * @var array
		 */
		protected $guarded = 
		[
			'userId'
		];

		/**
		 * The attributes excluded from the model's JSON form.
		 * 
		 * @var array
		 */
		protected $hidden =
		[
			'password',
			'remember_Token'
		];

		/**
		 * Get the Address model that is referenced in this User model.
		 * 
		 * @return Address
		 */
		public function address()
		{
			return $this->belongsTo('App\Models\Address', 'addressId');
		}

		/**
		 * Get all DistrictSection models that reference this User model (permissions).
		 *
		 * @return Collection -> DistrictSection
		 */
		public function districtSections()
		{
			return $this->belongsToMany('App\Models\DistrictSection', 'districtsectionpermissions', 'userId', 'districtSectionId');
		}

		/**
		 * Get all News models that reference this User model.
		 * 
		 * @return Collection -> News
		 */
		public function news()
		{
			return $this->hasMany('App\Models\News', 'userId');
		}

		/**
		 * Get all NewsComment models that reference this User model.
		 * 
		 * @return Collection -> NewsComment
		 */
		public function newsComments()
		{
			return $this->hasMany('App\Models\NewsComment', 'userId');
		}

		/**
		 * Get all Page models that reference this User model (permissions).
		 *
		 * @return Collection -> Page
		 */
		public function pages()
		{
			return $this->belongsToMany('App\Models\Page', 'pagepermissions', 'userId', 'pageId');
		}

		/**
		 * Get all Permission models that reference this User model (permissions).
		 *
		 * @return Collection -> Permission
		 */
		public function permissions()
		{
			return $this->belongsToMany('App\Models\Permission', 'userpermissions', 'userId', 'permissionId');
		}

		/**
		 * Get the Postal model that is referenced in this User model.
		 * 
		 * @return Postal
		 */
		public function postal()
		{
			return $this->belongsTo('App\Models\Postal', 'postalId');
		}

		/**
		 * Get the UserGroup model that is referenced in this User model.
		 * 
		 * @return UserGroup
		 */
		public function usergroup()
		{
			return $this->belongsTo('App\Models\UserGroup', 'userGroupId');
		}
	}