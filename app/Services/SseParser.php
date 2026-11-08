<?php

namespace App\Services;

use Closure;

/**
 * Incremental Server-Sent Events parser.
 *
 * Feed raw network chunks as they arrive; complete events are returned in order.
 * Partial lines spanning multiple reads are buffered internally, and both LF and
 * CRLF (even when split across chunk boundaries) are treated as line terminators.
 *
 * Only complete events are dispatched: an event is emitted on its terminating
 * blank line and only if it contains at least one non-empty "data:" line.
 * Comment/heartbeat lines (":...") are ignored.
 */
class SseParser
{
    protected string $buffer = '';

    protected ?string $eventName = null;

    protected string $data = '';

    protected ?string $eventId = null;

    protected ?int $retryMs = null;

    protected bool $discardingCurrentEvent = false;

    protected int $droppedEvents = 0;

    protected ?string $lastEventId = null;

    /**
     * Create a new parser.
     */
    public function __construct(
        protected readonly int $maxEventSize = 65536,
        protected readonly ?Closure $onDrop = null,
    ) {}

    /**
     * Feed the next raw chunk of the stream and return any completed events.
     *
     * @return list<SseEvent>
     */
    public function feed(string $chunk): array
    {
        $this->buffer .= $chunk;

        $events = [];

        while (($line = $this->nextLine()) !== null) {
            $event = $this->processLine($line);

            if ($event !== null) {
                $events[] = $event;
            }
        }

        // Bound memory if a line (or a run of them) never terminates.
        if (strlen($this->buffer) > $this->maxEventSize) {
            $this->buffer = '';
            $this->markCurrentEventAsTooLarge();
        }

        return $events;
    }

    /**
     * The most recent "id:" field seen, suitable for the Last-Event-ID header.
     */
    public function getLastEventId(): ?string
    {
        return $this->lastEventId;
    }

    /**
     * Number of events discarded for exceeding the maximum event size.
     */
    public function getDroppedEvents(): int
    {
        return $this->droppedEvents;
    }

    /**
     * Extract the next complete line (without its terminator) from the buffer,
     * or null when no complete line has arrived yet. Handles LF, CRLF and CR,
     * including a CRLF split across two chunks (a trailing lone CR waits for
     * the next byte before deciding).
     */
    protected function nextLine(): ?string
    {
        $bufferLength = strlen($this->buffer);
        $lineLength = strcspn($this->buffer, "\r\n");

        if ($lineLength >= $bufferLength) {
            return null;
        }

        $terminator = $this->buffer[$lineLength];

        // A lone CR at the very end of the buffer may be the first half of a
        // CRLF that spans chunks; wait for more bytes before consuming it.
        if ($terminator === "\r" && $lineLength + 1 === $bufferLength) {
            return null;
        }

        $line = substr($this->buffer, 0, $lineLength);

        $terminatorLength = 1;

        if ($terminator === "\r" && $this->buffer[$lineLength + 1] === "\n") {
            $terminatorLength = 2;
        }

        $this->buffer = substr($this->buffer, $lineLength + $terminatorLength);

        return $line;
    }

    /**
     * Process a single complete line and return an event when the line closes
     * out an event that should be dispatched.
     */
    protected function processLine(string $line): ?SseEvent
    {
        if ($line === '') {
            return $this->dispatchCurrentEvent();
        }

        if (str_starts_with($line, ':')) {
            return null; // Comment or heartbeat.
        }

        $field = $line;
        $value = '';

        $colonPosition = strpos($line, ':');

        if ($colonPosition !== false) {
            $field = substr($line, 0, $colonPosition);
            $value = substr($line, $colonPosition + 1);

            if (str_starts_with($value, ' ')) {
                $value = substr($value, 1);
            }
        }

        if ($this->discardingCurrentEvent) {
            return null; // Still draining fields of an oversized event.
        }

        switch ($field) {
            case 'data':
                $this->data = $this->data === '' ? $value : $this->data."\n".$value;

                if (strlen($this->data) > $this->maxEventSize) {
                    $this->markCurrentEventAsTooLarge();
                }
                break;

            case 'event':
                $this->eventName = $value;
                break;

            case 'id':
                if (! str_contains($value, "\0")) {
                    $this->eventId = $value;
                    $this->lastEventId = $value;
                }
                break;

            case 'retry':
                if (ctype_digit($value)) {
                    $this->retryMs = (int) $value;
                }
                break;
        }

        return null;
    }

    /**
     * Emit the event accumulated for the current block, if any.
     */
    protected function dispatchCurrentEvent(): ?SseEvent
    {
        if ($this->discardingCurrentEvent) {
            $this->resetCurrentEvent();
            $this->droppedEvents++;
            $this->onDrop?->__invoke();

            return null;
        }

        if ($this->data === '') {
            // No data lines arrived for this block; nothing to dispatch.
            $this->resetCurrentEvent();

            return null;
        }

        $event = new SseEvent(
            event: $this->eventName ?? 'message',
            data: $this->data,
            id: $this->eventId,
            retry: $this->retryMs,
        );

        $this->resetCurrentEvent();

        return $event;
    }

    /**
     * Drop the accumulated fields of the current event and swallow its
     * remaining lines until the event boundary is reached.
     */
    protected function markCurrentEventAsTooLarge(): void
    {
        $this->discardingCurrentEvent = true;
        $this->data = '';
    }

    protected function resetCurrentEvent(): void
    {
        $this->eventName = null;
        $this->data = '';
        $this->eventId = null;
        $this->retryMs = null;
        $this->discardingCurrentEvent = false;
    }
}
