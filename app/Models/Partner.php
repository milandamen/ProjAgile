<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Partner extends Model 
	{
		/**
		 * Table name.
		 * 
		 * @var string
		 */
		protected $table = 'partner';

		/**
		 * PrimaryKey name.
		 * 
		 * @var string
		 */
		protected $primaryKey = 'partnerId';

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
			'name', 
			'url'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 * 
		 * @var array
		 */
		protected $guarded = 
		[
			'partnerId'
		];
	}