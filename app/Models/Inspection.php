<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'turbine_id',
        'inspected_at',
    ];

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
