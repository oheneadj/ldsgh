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

     protected $casts = [
        'value' => 'array', // allows JSON storage if needed
    ];

    /**
     * Get a setting value by key
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        if (! $setting) {
            return $default;
        }

        // Auto-cast based on the type column
        return match ($setting->type) {
            'number' => (float) $setting->value,
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($setting->value, true),
            default => $setting->value,
        };
    }

    /**
     * Set or update a setting value
     */
    public static function setValue(string $key, $value, ?string $type = 'string', ?string $description = null)
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_array($value) ? json_encode($value) : $value,
                'type' => $type,
                'description' => $description,
            ]
        );}
}
