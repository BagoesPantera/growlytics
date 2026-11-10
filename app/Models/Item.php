<?php

namespace App\Models;

use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'normalized_name', 'slug'])]
class Item extends Model
{
    /** @use HasFactory<ItemFactory> */
    use HasFactory;

    /**
     * Get the listings for this item.
     *
     * @return HasMany<Listing, $this>
     */
    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }

    /**
     * Use the permanent slug for URLs when it exists, while retaining
     * numeric IDs for legacy URLs and internal relations.
     */
    public function getRouteKey(): mixed
    {
        return $this->slug ?: (string) $this->getKey();
    }

    public function resolveRouteBinding($value, $field = null): ?static
    {
        if ($field !== null) {
            return parent::resolveRouteBinding($value, $field);
        }

        $item = $this->where('slug', (string) $value)->first();

        if ($item === null && ctype_digit((string) $value)) {
            $item = $this->find((int) $value);
        }

        return $item;
    }
}
