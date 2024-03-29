<?php
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class NewOnSite extends Model
	{
		/**
		 * Table name.
		 *
		 * @var string
		 */
		protected $table = 'newonsite';

		/**
		 * PrimaryKey name.
		 *
		 * @var string
		 */
		protected $primaryKey = 'newonsiteId';

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
			'message', 
			'created_at', 
			'link'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 *
		 * @var array
		 */
		protected $guarded = 
		[
			'newonsiteId'
		];

		public function DateOnly()
		{
			$date = date_create($this->created_at);

			return date_format($date,'d-m-Y') ;
		}
	}