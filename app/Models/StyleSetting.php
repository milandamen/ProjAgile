<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class StyleSetting extends Model
	{
		/**
		 * Table name.
		 *
		 * @var string
		 */
		protected $table = 'stylesetting';

		/**
		 * PrimaryKey name.
		 *
		 * @var string
		 */
		protected $primaryKey = 'item';

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
			'item',
			'color',
			'setting'
		];

	}
