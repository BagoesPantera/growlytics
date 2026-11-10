<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Services\ItemSlugGenerator;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Database\UniqueConstraintViolationException;

#[Signature('growlytics:backfill-item-slugs {--batch=100 : Number of items processed per batch} {--dry-run : Report changes without writing them}')]
#[Description('Backfill permanent slugs for items that do not have one')]
class BackfillItemSlugs extends Command
{
    protected $aliases = [
        'items:backfill-slugs',
        'backfill:item-slugs',
        'items:backfill-item-slugs',
    ];

    public function handle(): int
    {
        $batchSize = max(1, (int) $this->option('batch'));
        $dryRun = (bool) $this->option('dry-run');

        $processed = 0;
        $updated = 0;
        $failed = 0;
        $failedItems = [];

        $this->info($dryRun ? 'Dry run: no slugs will be written.' : 'Backfilling missing item slugs.');

        Item::query()
            ->whereNull('slug')
            ->orderBy('id')
            ->chunkById($batchSize, function ($items) use (&$processed, &$updated, &$failed, &$failedItems, $dryRun): void {
                foreach ($items as $item) {
                    $processed++;

                    try {
                        $slug = ItemSlugGenerator::generateUniqueSlug($item->name);

                        if ($dryRun) {
                            $this->line(sprintf('Item #%d "%s" -> %s', $item->id, $item->name, $slug));
                        } else {
                            $affected = Item::query()
                                ->whereKey($item->id)
                                ->whereNull('slug')
                                ->update(['slug' => $slug]);

                            if ($affected === 0) {
                                $this->line(sprintf('Item #%d already has a slug; skipped.', $item->id));

                                continue;
                            }

                            $this->line(sprintf('Item #%d "%s" -> %s', $item->id, $item->name, $slug));
                        }

                        $updated++;
                    } catch (UniqueConstraintViolationException|\RuntimeException $exception) {
                        $failed++;
                        $failedItems[] = $item->id;

                        $this->warn(sprintf('Item #%d "%s" failed: %s', $item->id, $item->name, $exception->getMessage()));
                    }
                }
            });

        $this->newLine();
        $this->info(sprintf('Processed: %d', $processed));
        $this->info(sprintf('Updated: %d', $updated));
        $this->info(sprintf('Failed: %d', $failed));

        if ($failedItems !== []) {
            $this->warn('Failed item IDs: '.implode(', ', $failedItems));
        }

        return $failed === 0 ? self::SUCCESS : self::FAILURE;
    }
}
