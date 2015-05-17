<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Page extends Model 
	{
		/**
		 * Table name.
		 * 
		 * @var string
		 */
		protected $table = 'page';

		/**
		 * PrimaryKey name.
		 * 
		 * @var string
		 */
		protected $primaryKey = 'pageId';

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
			'sidebar',
			'introduction_introductionId'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 * 
		 * @var array
		 */
		protected $guarded = 
		[
			'pageId'
		];

		/** 
		 * Get all PagePanel models that reference this Page model.
		 * 
		 * @return Collection -> PagePanels
		 */
		public function panels()
		{
			return $this->hasMany('App\Models\PagePanel', 'page_id');
		}	

		public function introduction()
		{
			return $this->hasOne('App\Models\Introduction', 'introductionId', 'introduction_introductionId');
		}
	}