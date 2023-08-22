<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turbine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'farm_id',
        'lat',
        'lng',
    ];

    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
