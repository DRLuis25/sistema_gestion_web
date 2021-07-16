<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Audit
 * @package App\Models
 * @version June 26, 2021, 7:02 pm UTC
 *
 * @property \App\Models\User $user
 * @property string $description
 * @property integer $subject_id
 * @property string $subject_type
 * @property integer $user_id
 * @property string $properties
 * @property string $host
 */
class Audit extends Model
{
    public $table = 'logs';

    public $fillable = [
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'description' => 'string',
        'subject_id' => 'integer',
        'subject_type' => 'string',
        'user_id' => 'integer',
        'properties' => 'string',
        'host' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'description' => 'required|string',
        'subject_id' => 'nullable',
        'subject_type' => 'nullable|string|max:255',
        'user_id' => 'nullable',
        'properties' => 'nullable|string',
        'host' => 'nullable|string|max:46',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
