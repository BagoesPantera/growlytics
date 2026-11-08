<?php

namespace App\Services;

/**
 * A single, complete Server-Sent Event.
 */
class SseEvent
{
    /**
     * Create a new SSE event.
     */
    public function __construct(
        public readonly string $event,
        public readonly string $data,
        public readonly ?string $id,
        public readonly ?int $retry,
    ) {}
}
