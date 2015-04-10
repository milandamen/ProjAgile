<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Topic extends Model 
	{
		/**
	     * Table name.
	     * 
	     * @var string
	     */
		protected $table = 'topic';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
		protected $primaryKey = 'topicId';

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
			'forumId', 
			'userId',
			'name',
			'viewCount',
			'date',
			'sticky',
			'hidden'
		];

        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array()
         */
		protected $guarded = 
		[
			'topicId'
		];

        /**
         * Get all Comment models that reference this Topic model.
         * 
         * @return Collection -> Comment
         */
        public function children() 
        {
            return $this->hasMany('App\Models\Comment', 'topicId');
        }

        /**
         * Get the Forum model that is referenced in this Topic model.
         * 
         * @return Forum
         */
        public function forum() 
        {
            return $this->belongsTo('App\Models\Forum', 'forumId');
        }

        /**
         * Get the User model that is referenced in this Topic model.
         * 
         * @return User
         */
        public function user() 
        {
            return $this->belongsTo('App\Models\User', 'userId');
        }
	}