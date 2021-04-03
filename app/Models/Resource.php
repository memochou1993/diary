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
class Resource extends Model
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjectStatements()
    {
        return $this->hasMany(Statement::class, 'object_id');
    }

    public function objectStatements()
    {
        return $this->hasMany(Statement::class, 'subject_id');
    }

    public function isPublic()
    {
        return $this->objectStatements()->get()->some(function ($statement) {
            return $statement->predicate->name === 'is'
                && $statement->object->name === 'public';
        });
    }
}
