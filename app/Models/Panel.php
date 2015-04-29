<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Panel extends Model 
	{
		/**
	     * Table name.
	     * 
	     * @var string
	     */
		protected $table = 'panel';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
		protected $primaryKey = 'panelId';

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
			'size',
		];

        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array
         */
		protected $guarded = 
		[
			'panelId'
		];

			/** 
		 * Get all PagePanel models that reference this Panel model.
		 * 
		 * @return Collection -> PagePanels
		 */
		public function pages()
		{
	        return $this->hasMany('App\Models\PagePanel', 'panel_id');
		}

	}