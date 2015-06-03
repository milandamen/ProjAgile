<?php
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Address extends Model
	{
		/**
		 * Table name.
		 *
		 * @var string
		 */
		protected $table = 'address';

		/**
		 * PrimaryKey name.
		 *
		 * @var string
		 */
		protected $primaryKey = 'addressId';

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
			'postalId',
			'houseNumberId',
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 *
		 * @var array
		 */
		protected $guarded =
		[
			'addressId'
		];

		/**
		 * Get the HouseNumber model that is referenced in this Address model.
		 *
		 * @return HouseNumber
		 */
		public function houseNumber()
		{
			return $this->belongsTo('App\Models\HouseNumber', 'houseNumberId');
		}

		/**
		 * Get the Postal model that is referenced in this Address model.
		 *
		 * @return Postal
		 */
		public function postal()
		{
			return $this->belongsTo('App\Models\Postal', 'postalId');
		}

		/**
		 * Get the User model that references this Address model.
		 *
		 * @return User
		 */
		public function user()
		{
			return $this->hasOne('App\Models\User', 'addressId');
		}
	}