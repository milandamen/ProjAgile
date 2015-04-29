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

	}