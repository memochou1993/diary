<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property Resource $subject
 * @property Predicate $predicate
 * @property Resource $object
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Statement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'predicate_id',
        'object_id',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function subject()
    {
        return $this->belongsTo(Resource::class, 'subject_id');
    }

    public function object()
    {
        return $this->belongsTo(Resource::class, 'object_id');
    }

    public function predicate()
    {
        return $this->belongsTo(Predicate::class);
    }
}
