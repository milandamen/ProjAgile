<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class HouseNumber extends Model
	{
		/**
		 * Table name.
		 *
		 * @var string
		 */
		protected $table = 'housenumber';

		/**
		 * PrimaryKey name.
		 *
		 * @var string
		 */
		protected $primaryKey = 'houseNumberId';

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
			'houseNumber',
			'suffix',
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 *
		 * @var array
		 */
		protected $guarded =
		[
			'houseNumberId'
		];

		/**
		 * Get all Address models that reference this HouseNumber model.
		 * 
		 * @return Collection -> Address
		 */
		public function address()
		{
			return $this->hasMany('App\Models\Address', 'houseNumberId');
		}
	}