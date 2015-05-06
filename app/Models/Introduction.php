<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Introduction extends Model 
    {
        /**
         * Table name.
         * 
         * @var string
         */
        protected $table = 'introduction';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
        protected $primaryKey = 'introductionId';

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
        	'pageId', 
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
        	'introductionId'
        ];


        public function page()
		{
	        return $this->hasOne('App\Models\Page', 'pageId');
		}
    }