<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class PagePanel extends Model 
	{
		/**
	     * Table name.
	     * 
	     * @var string
	     */
		protected $table = 'panel_page';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
		protected $primaryKey = 'pagepanelId';

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
			'page_id',
			'panel_id',
			'title',
			'text'
		];

        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array
         */
		protected $guarded = 
		[
			'pagepanelId'
		];

			/** 
		 * Get all Page models that reference this Pagepanel model.
		 * 
		 * @return Collection -> Page
		 */
		public function pages()
		{
	        return $this->belongsTo('App\Models\Page', 'page_id');
		}

			/** 
		 * Get all Panel models that reference this Pagepanel model.
		 * 
		 * @return Collection -> PagePanels
		 */
		public function panel()
		{
	        return $this->belongsTo('App\Models\Panel', 'panel_id');
		}



	}