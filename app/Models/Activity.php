<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Activity extends Model 
	{
		/**
	     * Table name.
	     * 
	     * @var string
	     */
		protected $table = 'activity';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
		protected $primaryKey = 'activityId';

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
			'districtSectionId', 
			'title',
			'content',
			'hidden',
		];

        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array()
         */
		protected $guarded = 
		[
			'activityId'
		];

		/**
		 * Get the DistrictSection model that is referenced in this Activity model.
		 * 
		 * @return DistrictSection
		 */
		public function districtSection() 
		{
			return $this->belongsTo('App\Models\DistrictSection');
		}
	}