<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'footer';

    /**
     * PrimaryKey name.
     *
     * @var string
     */
    protected $primaryKey = 'footerId';

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
        'text'
    ];

    /**
     * Attributes that cannot be changed and thus are not mass assingable.
     *
     * @var array()
     */
    protected $guarded =
    [
        'footerId'
    ];
}

