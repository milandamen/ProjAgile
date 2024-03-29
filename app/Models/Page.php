<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;
	use Carbon\Carbon;

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
			'introduction_introductionId',
			'publishDate',
			'publishEndDate',
			'visible',
			'parentId',
			'districtsection_districtSectionId'
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

		public function now(){
			return Carbon::now()->format('d-m-Y H:i');
		}

		public function getPublishDateAttribute($value)
		{
			if (!isset($value) || empty($value))
			{
				$value = Carbon::now('Europe/Amsterdam');
			}

			return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y H:i');
		}

		public function setPublishDateAttribute($value)
		{
			$this->attributes['publishDate'] = Carbon::parse($value)->format('Y-m-d H:i');
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
		 * Get all PagePanel models that reference this Page model.
		 * 
		 * @return Collection -> PagePanels
		 */
		public function panels()
		{
			return $this->hasMany('App\Models\PagePanel', 'page_id');
		}	

		/**
		 * Get the Introduction model that is referened in this Page model.
		 *
		 * @return Introduction
		 */
		public function introduction()
		{
			return $this->hasOne('App\Models\Introduction', 'introductionId', 'introduction_introductionId');
		}

				/**
		 * Check if the usergroup has permission to edit the given page
		 *
		 * @param $pageId
		 * @return Boolean
		 */
		public function groups()
		{
			return $this->belongsToMany('App\Models\UserGroup', 'usergrouppagepermissions', 'pageId', 'userGroupId');
		}

		public function groupsView()
		{
			return $this->belongsToMany('App\Models\UserGroup', 'usergrouppageviewpermissions', 'pageId', 'userGroupId');
		}

		/**
		 * Get all User models that reference this Page model (permissions).
		 *
		 * @return Collection -> Page
		 */
		public function users()
		{
			return $this->belongsToMany('App\Models\User', 'pagepermissions', 'pageId', 'userId');
		}

		public function usersView()
		{
			return $this->belongsToMany('App\Models\User', 'pageviewpermissions', 'pageId', 'userId');
		}


		/**
		 * Get all DistrictSection models that reference this Page model.
		 *
		 * @return Collection -> DistrictSection
		 */
		public function districtSections()
		{
			return $this->belongsToMany('App\Models\DistrictSection', 'districtsection_has_page', 'page_pageId', 'districtsection_districtSectionId');
		}

		/**
		 * Checks if the page is part of the "Home" district, if so it's publically visible
		 *
		 * @return Collection -> DistrictSection
		 */
		public function hasDistrictSection($districtSectionId)
		{
			return $this->districtSections->contains($districtSectionId);
		}
		
	}