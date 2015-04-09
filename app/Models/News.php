<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class News extends Model 
	{
		/**
		 * Table name.
		 * 
		 * @var string
		 */
		protected $table = 'news';

		/**
		 * PrimaryKey name.
		 * 
		 * @var string
		 */
		protected $primaryKey = 'newsId';

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
			'districtsectionId', 
			'userId', 
			'title', 
			'content', 
			'date', 
			'hidden', 
			'commentable',
			'publishStartDate',
			'publishEndDate',
			'top'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 * 
		 * @var array()
		 */
		protected $guarded = 
		[
			'newsId'
		];

		/**
		 * Get the District model that is referenced in this News model.
		 * 
		 * @return Districtsection
		 */
		public function district() 
		{
			return $this->belongsTo('App\Models\Districtsection', 'districtsectionId');
		}


		/**
		 * Get the User model that is referenced in this News model.
		 * 
		 * @return User
		 */
		public function user() 
		{
	        return $this->belongsTo('App\Models\User', 'userId');
		}

		/**
		 * Get all File models that reference this News model.
		 * 
		 * @return Collection -> File
		 */
		public function files() 
		{
			return $this->hasMany('App\Models\File', 'fileId');
		}

		/**
		 * Get all Carousel models that reference this News model.
		 * 
		 * @return Collection -> Carousel
		 */
		public function carousel() 
		{
			return $this->hasMany('App\Models\Carousel', 'foreign_key', 'newsId');
		}
	}