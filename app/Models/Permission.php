<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	/**
	 * Table name.
	 *
	 * @var string
	 */
	protected $table = 'permission';

	/**
	 * PrimaryKey name.
	 *
	 * @var string
	 */
	protected $primaryKey = 'permissionId';

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
			'permissionName'
		];

	/**
	 * Attributes that cannot be changed and thus are not mass assingable.
	 *
	 * @var array
	 */
	protected $guarded =
		[
			'permissionId'
		];

}