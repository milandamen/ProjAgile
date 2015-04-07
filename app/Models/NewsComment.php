<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newscomment extends Model {

    protected $table = 'newscomment';

    # Primary Key
    protected $primaryKey = 'newscommentId';
    protected $guarded = ['newscommentId'];

    # Properties that can be changed
    protected $fillable = ['message', 'newsId', 'userId'];

    # Keys used in newscomment
    public function news() {
        return $this->belongsTo('App\Models\News', 'newsId');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'userId');
    }

}