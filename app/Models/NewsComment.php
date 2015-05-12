<?php 
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Newscomment extends Model 
    {
        /**
         * Table name.
         * 
         * @var string
         */
        protected $table = 'newsComment';

        /**
         * PrimaryKey name.
         * 
         * @var string
         */
        protected $primaryKey = 'newsCommentId';

        /**
         * Laravel's automatic timestamps convention.
         * 
         * @var bool
         */
        public $timestamps = true;

        /**
         * Attributes that can be changed and thus are mass assingable.
         * 
         * @var array
         */
        protected $fillable = 
        [
            'newsId', 
            'userId',
            'message',
            'created_at',
            'updated_at'
        ];

        /**
         * Attributes that cannot be changed and thus are not mass assingable.
         * 
         * @var array
         */
        protected $guarded = 
        [
            'newsCommentId'
        ];

        /**
         * Get the News model that is referenced in this NewsComment model.
         * 
         * @return News
         */
        public function news() 
        {
            return $this->belongsTo('App\Models\News', 'newsId');
        }

        /**
         * Get the User model that is referenced in this NewsComment model.
         * 
         * @return News
         */
        public function user() 
        {
            return $this->belongsTo('App\Models\User', 'userId');
        }
    }