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
         * Get the date of this news item, in a d-m-Y format (so without the time).
         * In order to call this, call $newsItem->normalDate() and NOT $newsItem->normalDate.
         *
         * @return string
         */
        public function normalDate()
        {
            $date = date_create($this->date);

            return date_format($date,'d-m-Y') ;
        }

		/**
		 * Get all Carousel models that reference this News model.
		 * 
		 * @return Collection -> Carousel
		 */
		public function carousels() 
		{
			return $this->hasMany('App\Models\Carousel', 'newsId');
		}

		/**
		 * Get the DistrictSection model that is referenced in this News model.
		 * 
		 * @return DistrictSection
		 */
		public function districtSection() 
		{
			return $this->belongsTo('App\Models\DistrictSection', 'districtSectionId');
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
		 * Get all NewsComment models that reference this News model.
		 * 
		 * @return Collection -> NewsComment
		 */
		public function newsComments() 
		{
			return $this->hasMany('App\Models\NewsComment', 'newsId');
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
	}