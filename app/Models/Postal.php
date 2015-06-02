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
		 * Get all Address models that reference this HouseNumber model.
		 * 
		 * @return Collection -> Address
		 */
		public function address()
		{
			return $this->hasMany('App\Models\Address', 'addressId');
		}
	}