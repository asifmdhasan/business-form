<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'type'];

    /**
     * Get a single setting value by key.
     */
    public static function get(string $key, $default = null)
    {
        $cacheKey = 'site_setting_' . $key;

        $value = Cache::rememberForever($cacheKey, function () use ($key) {
            return static::where('key', $key)->value('value');
        });

        return $value !== null && $value !== '' ? $value : $default;
    }

    /**
     * Get many settings at once as [key => value] array.
     * Useful for loading a whole section on an edit form.
     */
    public static function getMany(array $keys, array $defaults = []): array
    {
        $result = [];
        foreach ($keys as $key) {
            $result[$key] = static::get($key, $defaults[$key] ?? null);
        }
        return $result;
    }

    /**
     * Set (create or update) a setting value.
     */
    public static function set(string $key, $value, string $type = 'text'): self
    {
        $row = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );

        Cache::forget('site_setting_' . $key);

        return $row;
    }

    /**
     * Set many settings at once from an associative array [key => value].
     */
    public static function setMany(array $data, string $type = 'text'): void
    {
        foreach ($data as $key => $value) {
            static::set($key, $value, $type);
        }
    }
}
