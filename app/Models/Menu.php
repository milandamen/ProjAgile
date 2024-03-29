<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Menu extends Model
	{
		/**
		 * Table name.
		 * 
		 * @var string
		 */
		protected $table = 'menu';

		/**
		 * PrimaryKey name.
		 * 
		 * @var string
		 */
		protected $primaryKey = 'menuId';

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
			'parentId', 
			'name', 
			'link',
			'menuOrder', 
			'publish'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 * 
		 * @var array
		 */
		protected $guarded = 
		[
			'menuId'
		];

		/**
		 * Get all Menu models that reference this Menu model.
		 * 
		 * @return Collection -> Menu
		 */
		public function children() 
		{
			return $this->hasMany('App\Models\Menu', 'menuId');
		}

		/**
		 * Get the Menu model that is referenced in this Menu model.
		 * 
		 * @return Menu
		 */
		public function father() 
		{
			return $this->belongsTo('App\Models\Menu', 'menuId');
		}
	}