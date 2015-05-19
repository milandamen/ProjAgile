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
			'districtSectionId',
			'postalId',
			'username',
			'firstName', 
			'surname',
			'password',
			'houseNumber', 
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
		 * Get all Comment models that reference this User model.
		 * 
		 * @return Collection -> Comment
		 */
		public function comments()
		{
			return $this->hasMany('App\Models\Comment', 'userId');
		}

		/**
		 * Get the DistrictSection model that is referenced in this User model.
		 * 
		 * @return DistrictSection
		 */
		public function districtSection() 
		{
			return $this->belongsTo('App\Models\DistrictSection', 'districtSectionId');
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
		 * Get the Postal model that is referenced in this User model.
		 * 
		 * @return Postal
		 */
		public function postal()
		{
			return $this->belongsTo('App\Models\Postal', 'postalId');
		}

		/**
		 * Get all Topic models that reference this User model.
		 * 
		 * @return Collection -> Topic
		 */
		public function topics()
		{
			return $this->hasMany('App\Models\Topic', 'userId');
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