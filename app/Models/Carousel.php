<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Carousel extends Model 
	{
		/**
		 * Table name.
		 * 
		 * @var string
		 */
		protected $table = 'carousel';

		/**
		 * PrimaryKey name.
		 * 
		 * @var string
		 */
		protected $primaryKey = 'carouselId';

		/**
		 * Laravel's automatic timestamps convention.
		 * 
		 * @var bool
		 */
		public $timestamps = false;

		/**
		 * Attributes that can be changed and thus are mass assignable.
		 * 
		 * @var array
		 */
		protected $fillable = 
		[
			'newsId',
			'pageId',
			'title',
			'publishStartDate',
			'publishEndDate',
			'imagePath',
			'description'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assignable.
		 * 
		 * @var array
		 */
		protected $guarded = 
		[
			'carouselId'
		];

		/**
		 * Get the News model that is referenced in this Carousel model.
		 * 
		 * @return News
		 */
		public function news() 
		{
			return $this->belongsTo('App\Models\News', 'newsId');
		}

		/**
		 * Get the Page model that is referenced in this Carousel model.
		 *
		 * @return Page
		 */
		public function page()
		{
			return $this->belongsTo('App\Models\Page', 'pageId');
		}
	}