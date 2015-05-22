<?php 
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Forum extends Model 
	{
		/**
		 * Table name.
		 * 
		 * @var string
		 */
		protected $table = 'forum';

		/**
		 * PrimaryKey name.
		 * 
		 * @var string
		 */
		protected $primaryKey = 'forumId';

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
			'name', 
			'description'
		];

		/**
		 * Attributes that cannot be changed and thus are not mass assingable.
		 * 
		 * @var array
		 */
		protected $guarded = 
		[
			'forumId'
		];

		/**
		 * Get all Topic models that reference this Forum model.
		 * 
		 * @return Collection -> Topic
		 */
		public function topics() 
		{
			return $this->hasMany('App\Models\Topic', 'forumId');
		}
	}