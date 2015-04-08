<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Sidebar extends Model 
	{
		/**
		 * Table name
		 * 
		 * @var string
		 */
		protected $table = 'sidebar';

		/**
		 * PrimaryKey name
		 * 
		 * @var string
		 */
		protected $primaryKey = 'id';

		/**
		 * Laravel's automatic timestamps convention
		 * 
		 * @var boolean
		 */
		public $timestamps = false;

		/**
		 * Attributes that can be changed and thus are mass assingable
		 * 
		 * @var array()
		 */
		protected $fillable = 
		[
			'pageNr',
			'rowNr', 
			'title', 
			'text', 
			'internlink', 
			'externlink'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable
		 * 
		 * @var array()
		 */
		protected $guarded = 
		[
			'id'
		];
	}