<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',      // e.g., 'base_fare', 'per_km_rate', 'per_kg_rate'
        'value',    // the actual value (string, numeric, JSON, etc.)
        'type',     // optional: 'number', 'string', 'json' for type hinting
        'description', // optional: human-readable explanation
    ];
}
