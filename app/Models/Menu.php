<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'menu';

    # Primary Key  // In current model this is auto-incremented
    protected $primaryKey = 'menuId';
    protected $guarded = ['menuId'];

    # Properties that can be changed
    protected $fillable = ['parentId', 'name', 'relativeUrl', 'menuOrder', 'publish'];

    # Laravel's automatic timestamps (like updated_at)
    public $timestamps = false;

    #Foreign Keys
    # none.

}

?>