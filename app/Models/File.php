<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class File extends Model 
	{
	    /**
	     * Table name.
	     * 
	     * @var string
	     */
		protected $table = 'file';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
		protected $primaryKey = 'fileId';

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
			'newsId', 
			'path'
		];

        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array()
         */
		protected $guarded = 
		[
			'fileId'
		];

		/**
		 * Get the News model that is referenced in this File model.
		 * 
		 * @return News
		 */
		public function news() 
		{
			return $this->belongsTo('App\Models\News');
		}
	}