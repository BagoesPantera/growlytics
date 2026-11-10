<?php

use App\Models\Setting;

if (! function_exists('versioned_asset')) {
    function versioned_asset(string $path): string
    {
        static $versions = [];

        if (! isset($versions[$path])) {
            $fullPath = public_path($path);

            $versions[$path] = file_exists($fullPath)
                ? filemtime($fullPath)
                : time();
        }

        return asset($path).'?v='.$versions[$path];
    }
}

if (! function_exists('guest_asset')) {
    /**
     * Versioned asset URL for files under public/guest.
     */
    function guest_asset(string $path): string
    {
        return versioned_asset('guest/'.ltrim($path, '/'));
    }
}

if (! function_exists('getSetting')) {
    function getSetting(string $key, mixed $default = null): mixed
    {
        return Setting::where('unique_key', $key)->value('value') ?? $default;
    }
}

if (! function_exists('upload_asset')) {
    /**
     * Return the public URL used to serve a file stored on the public storage disk.
     * Null-safe: returns null for null/empty paths.
     */
    function upload_asset(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        $path = ltrim($path, '/');
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8);
        }

        return asset('storage/'.$path);
    }
}
