<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * @property int $id
 * @property string $token
 */
class Token extends PersonalAccessToken
{
    use HasFactory;

    public function model()
    {
        return $this->morphTo('model');
    }

    public function tokenable()
    {
        return $this->model();
    }
}
