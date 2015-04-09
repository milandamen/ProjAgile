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
			'userGroupId', 
			'districtSectionId',
			'postalId',
			'username', 
			'password',
			'firstName', 
			'surname', 
			'houseNumber', 
			'email', 
			'active',
			'remember_Token'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 * 
		 * @var array()
		 */
		protected $guarded = 
		[
			'userId'
		];

		/**
		 * The attributes excluded from the model's JSON form.
		 * 
		 * @var array()
		 */
	    protected $hidden =
	    [
	        'password',
	        'remember_Token'
	    ];

		/**
		 * Get the District model that is referenced in this User model.
		 * 
		 * @return Districtsection
		 */
		public function district() 
		{
			return $this->belongsTo('App\Models\District', 'foreign_key');
		}

		/**
		 * Get the UserGroup model that is referenced in this User model.
		 * 
		 * @return UserGroup
		 */
		public function usergroup()
		{
			return $this->belongsTo('App\Models\UserGroup', 'foreign_key');
		}

		/**
		 * Get all News models that reference this User model.
		 * 
		 * @return Collection -> News
		 */
		public function news()
		{
	        return $this->hasMany('App\Models\News', 'newsId');
		}
	}