<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Postal extends Model
	{
		/**
		 * Table name.
		 *
		 * @var string
		 */
		protected $table = 'postal';

		/**
		 * PrimaryKey name.
		 *
		 * @var string
		 */
		protected $primaryKey = 'postalId';

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
			'code',
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 *
		 * @var array
		 */
		protected $guarded =
		[
			'postalId'
		];

		/**
		 * Get the DistrictSection model that is referenced in this Postal model.
		 * 
		 * @return DistrictSection
		 */
		public function districtSection() 
		{
			return $this->belongsTo('App\Models\DistrictSection', 'districtSectionId');
		}

		/**
		 * Get all User models that reference this Postal model.
		 * 
		 * @return Collection -> User
		 */
		public function users()
		{
			return $this->hasMany('App\Models\User', 'postalId');
		}
	}