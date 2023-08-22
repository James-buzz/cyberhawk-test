<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'component_type_id',
        'turbine_id',
    ];

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
