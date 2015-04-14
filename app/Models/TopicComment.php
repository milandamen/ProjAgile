<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Comment extends Model 
	{
		/**
	     * Table name.
	     * 
	     * @var string
	     */
		protected $table = 'topicComment';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
		protected $primaryKey = 'topicCommentId';

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
			'topicId', 
			'userId',
			'message',
			'date',
			'hidden'
		];

        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array
         */
		protected $guarded = 
		[
			'commentId'
		];

		/**
		 * Get the Topic model that is referenced in this Comment model.
		 * 
		 * @return Topic
		 */
		public function topic() 
		{
			return $this->belongsTo('App\Models\Topic', 'topicId');
		}

		/**
		 * Get the User model that is referenced in this Comment model.
		 * 
		 * @return News
		 */
		public function user() 
		{
			return $this->belongsTo('App\Models\User', 'userId');
		}
	}