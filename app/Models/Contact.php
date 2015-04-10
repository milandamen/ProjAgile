<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Contact extends Model 
	{
		/**
	     * Table name.
	     * 
	     * @var string
	     */
		protected $table = 'contact';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
		protected $primaryKey = 'contactId';

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
			'name',
			'email',
			'street',
			'houseNumber',
			'postal',
			'city',
			'telephone',
			'position',
		];

        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array()
         */
		protected $guarded = 
		[
			'contactId'
		];

		/**
		 * Get the DistrictSection model that is referenced in this Contact model.
		 * 
		 * @return DistrictSection
		 */
		public function districtSection() 
		{
			return $this->belongsTo('App\Models\DistrictSection');
		}
	}