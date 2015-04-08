<?php 
	amespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Introduction extends Model 
	{
        /**
         * Table name
         * 
         * @var string
         */
		protected $table = 'introduction';

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
			'pageId', 
			'title', 
			'text'
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