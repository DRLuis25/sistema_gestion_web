<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package App\Models
 * @version June 26, 2021, 6:18 am UTC
 *
 * @property \App\Models\ModelHasRole $modelHasRole
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 * @property string $name
 * @property string $guard_name
 */
class Role extends Model
{

    public $table = 'roles';

    public $fillable = [
        'name',
        'guard_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'permission' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function modelHasRole()
    {
        return $this->hasOne(\App\Models\ModelHasRole::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function permissionss()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'role_has_permissions');
    }
}
