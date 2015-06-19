<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;
	use Carbon\Carbon;

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
			'districtSectionId', 
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
		 * @var array
		 */
		protected $guarded = 
		[
			'newsId'
		];

		public function getPublishStartDateAttribute($value)
		{
			if (!isset($value) || empty($value))
			{
				$value = Carbon::now('Europe/Amsterdam');
			}

			return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y H:i');
		}

		public function setPublishStartDateAttribute($value)
		{
			$this->attributes['publishStartDate'] = Carbon::parse($value)->format('Y-m-d H:i');
		}

		/**
		 * Set the date of this news item, in a d-m-Y H:i format.
		 *
		 * @return void
		 */
		public function getPublishEndDateAttribute($value)
		{
			if (!isset($value) || empty($value))
			{
				$value = Carbon::now('Europe/Amsterdam');
			}

			return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y H:i');
		}

		/**
		 * Set the date of this news item, in a d-m-Y H:i format.
		 *
		 * @return void
		 */
		public function setPublishEndDateAttribute($value)
		{
			$this->attributes['publishEndDate'] = Carbon::parse($value)->format('Y-m-d H:i');
		}

		/**
		 * Get the date of this news item, in a d-m-Y format (so without the time).
		 * In order to call this, call $newsItem->normalDate() and NOT $newsItem->normalDate.
		 *
		 * @return string
		 */
		public function normalDate()
		{
			$date = date_create($this->publishStartDate);

			return date_format($date,'d-m-Y') ;
		}

        public function endDate()
        {
            $date = date_create($this->publishEndDate);

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
		 * Get all File models that reference this News model.
		 * 
		 * @return Collection -> File
		 */
		public function files() 
		{
			return $this->hasMany('App\Models\File', 'newsId');
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

		/**
		 * Get all DistrictSection models that reference this News model (permissions).
		 *
		 * @return Collection -> DistrictSection
		 */
		public function districtSections()
		{
			return $this->belongsToMany('App\Models\DistrictSection', 'newsdistrictsection', 'newsId', 'districtSectionId');
		}

		/**
		 * Checks if the news item is part of the "Home" district, if so it's publically visible
		 *
		 * @return Collection -> DistrictSection
		 */
		public function hasDistrictSection($districtSectionId)
		{
			return $this->districtSections->contains($districtSectionId);
		}
	}