<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Task.
 *
 * @package namespace App\Models;
 */
class Task extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'completed',
        'editing',
        'target_date',
        'completed_at'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'completed' => 'boolean',
        'editing' => 'boolean',
        'target_date' => 'date',
        'completed_at' => 'date',
    ];

    protected $hidden = ['created_at', 'updated_at', 'completed_at'];

}
