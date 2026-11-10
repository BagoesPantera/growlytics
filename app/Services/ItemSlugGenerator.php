<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Str;

class ItemSlugGenerator
{
    public const SUFFIX_LENGTH = 5;

    public const MAX_SLUG_LENGTH = 255;

    public const DEFAULT_MAX_ATTEMPTS = 10;

    private const SUFFIX_CHARACTERS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * Generate a unique, permanent slug for an item name.
     *
     * @throws \RuntimeException when a unique slug cannot be generated.
     */
    public static function generateUniqueSlug(string $name, int $maxAttempts = self::DEFAULT_MAX_ATTEMPTS): string
    {
        $prefix = self::prefixFor($name);

        for ($attempt = 0; $attempt < max(1, $maxAttempts); $attempt++) {
            $slug = $prefix.'-'.self::randomSuffix();

            if (! self::slugExists($slug)) {
                return $slug;
            }
        }

        throw new \RuntimeException('Unable to generate a unique item slug.');
    }

    /**
     * Alias used by tests and callers that expect a simpler generator API.
     */
    public static function generate(string $name, int $maxAttempts = self::DEFAULT_MAX_ATTEMPTS): string
    {
        return self::generateUniqueSlug($name, $maxAttempts);
    }

    public static function generateSlug(string $name, int $maxAttempts = self::DEFAULT_MAX_ATTEMPTS): string
    {
        return self::generateUniqueSlug($name, $maxAttempts);
    }

    public static function make(string $name, int $maxAttempts = self::DEFAULT_MAX_ATTEMPTS): string
    {
        return self::generateUniqueSlug($name, $maxAttempts);
    }

    public static function makeSlug(string $name, int $maxAttempts = self::DEFAULT_MAX_ATTEMPTS): string
    {
        return self::generateUniqueSlug($name, $maxAttempts);
    }

    public static function prefixFor(string $name): string
    {
        $prefix = Str::slug($name);

        if ($prefix === '') {
            $prefix = 'item';
        }

        $maxLength = self::MAX_SLUG_LENGTH - self::SUFFIX_LENGTH - 1;

        if (mb_strlen($prefix) > $maxLength) {
            $prefix = mb_substr($prefix, 0, $maxLength);
            $prefix = rtrim($prefix, '-');
        }

        if ($prefix === '') {
            $prefix = 'item';
        }

        return $prefix;
    }

    public static function randomSuffix(): string
    {
        $suffix = '';
        $maxIndex = strlen(self::SUFFIX_CHARACTERS) - 1;

        for ($i = 0; $i < self::SUFFIX_LENGTH; $i++) {
            $suffix .= self::SUFFIX_CHARACTERS[random_int(0, $maxIndex)];
        }

        return $suffix;
    }

    protected static function slugExists(string $slug): bool
    {
        return Item::query()
            ->whereRaw('LOWER(slug) = ?', [mb_strtolower($slug)])
            ->exists();
    }
}
