<?php 
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class MenuItem extends Model
    {
        /**
         * Table name
         * 
         * @var string
         */
        protected $table = 'menu';

        /**
         * PrimaryKey name
         * 
         * @var string
         */
        protected $primaryKey = 'menuId'

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
            'parentId', 
            'name', 
            'relativeUrl', 
            'menuOrder', 
            'publish'
        ];

        /**
         * Attributes that cannot be changed and thus are not mass assingable
         * 
         * @var array()
         */
        protected $guarded = 
        [
            'menuId'
        ];
    }