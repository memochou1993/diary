<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Predicate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Resource::class, 'statements', 'predicate_id', 'subject_id');
    }

    public function objects()
    {
        return $this->belongsToMany(Resource::class, 'statements', 'predicate_id', 'object_id');
    }
}
