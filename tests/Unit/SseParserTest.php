<?php

namespace Tests\Unit;

use App\Services\SseParser;
use PHPUnit\Framework\TestCase;

class SseParserTest extends TestCase
{
    public function test_parses_a_simple_event(): void
    {
        $parser = new SseParser;

        $events = $parser->feed("data: {\"id\": 1}\n\n");

        $this->assertCount(1, $events);
        $this->assertSame('message', $events[0]->event);
        $this->assertSame('{"id": 1}', $events[0]->data);
        $this->assertNull($events[0]->id);
        $this->assertNull($events[0]->retry);
    }

    public function test_joins_multiple_data_lines_with_newlines(): void
    {
        $parser = new SseParser;

        $events = $parser->feed("data: first\ndata: second\n\n");

        $this->assertCount(1, $events);
        $this->assertSame("first\nsecond", $events[0]->data);
    }

    public function test_captures_event_id_and_retry_fields(): void
    {
        $parser = new SseParser;

        $events = $parser->feed("event: listing\nid: evt-42\nretry: 3000\ndata: {}\n\n");

        $this->assertCount(1, $events);
        $this->assertSame('listing', $events[0]->event);
        $this->assertSame('evt-42', $events[0]->id);
        $this->assertSame(3000, $events[0]->retry);
        $this->assertSame('evt-42', $parser->getLastEventId());
    }

    public function test_ignores_non_numeric_retry_values(): void
    {
        $parser = new SseParser;

        $events = $parser->feed("retry: soon\ndata: {}\n\n");

        $this->assertCount(1, $events);
        $this->assertNull($events[0]->retry);
    }

    public function test_ignores_comment_and_heartbeat_lines(): void
    {
        $parser = new SseParser;

        $this->assertSame([], $parser->feed(": heartbeat\n\n"));
        $this->assertSame([], $parser->feed(":ping\n"));
    }

    public function test_does_not_dispatch_events_without_data(): void
    {
        $parser = new SseParser;

        $this->assertSame([], $parser->feed("event: ping\nid: 1\n\n"));
    }

    public function test_parses_multiple_events_from_a_single_chunk(): void
    {
        $parser = new SseParser;

        $events = $parser->feed("data: one\n\ndata: two\n\ndata: three\n\n");

        $this->assertCount(3, $events);
        $this->assertSame(['one', 'two', 'three'], array_map(
            fn ($event) => $event->data,
            $events,
        ));
    }

    public function test_handles_partial_chunks_spanning_multiple_feeds(): void
    {
        $parser = new SseParser;

        $this->assertSame([], $parser->feed('data: {"id": 839'));
        $this->assertSame([], $parser->feed('8863", "side": "sell"}'));
        $events = $parser->feed("\n\n");

        $this->assertCount(1, $events);
        $this->assertSame('{"id": 8398863", "side": "sell"}', $events[0]->data);
    }

    public function test_handles_crlf_line_endings(): void
    {
        $parser = new SseParser;

        $events = $parser->feed("data: {\"id\": 1}\r\n\r\n");

        $this->assertCount(1, $events);
        $this->assertSame('{"id": 1}', $events[0]->data);
    }

    public function test_handles_crlf_split_across_chunk_boundaries(): void
    {
        $parser = new SseParser;

        $this->assertSame([], $parser->feed("data: one\r"));
        // The lone CR could be a CRLF split in half: nothing dispatched yet.
        $this->assertSame([], $parser->feed("\n"));
        // The completed CRLF plus the next blank line close out the event.
        $events = $parser->feed("\n\ndata: two\n\n");

        $this->assertCount(2, $events);
        $this->assertSame('one', $events[0]->data);
        $this->assertSame('two', $events[1]->data);
    }

    public function test_handles_bare_cr_line_endings(): void
    {
        $parser = new SseParser;

        // A lone CR at the end of a chunk is held back until the next byte
        // arrives, so a CRLF split across chunks is never misread.
        $events = $parser->feed("data: one\r\rdata: two\r\rx\n");

        $this->assertCount(2, $events);
        $this->assertSame('one', $events[0]->data);
        $this->assertSame('two', $events[1]->data);
    }

    public function test_drops_events_exceeding_the_maximum_size(): void
    {
        $parser = new SseParser(maxEventSize: 32);

        $events = $parser->feed('data: '.str_repeat('x', 64)."\n\ndata: ok\n\n");

        $this->assertCount(1, $events); // Only the small trailing event survives.
        $this->assertSame('ok', $events[0]->data);
        $this->assertSame(1, $parser->getDroppedEvents());
    }

    public function test_bounds_memory_for_unterminated_lines(): void
    {
        $parser = new SseParser(maxEventSize: 32);

        // A single unterminated line far beyond the cap must not accumulate.
        $this->assertSame([], $parser->feed(str_repeat('y', 128)));
        $this->assertSame(0, $parser->getDroppedEvents());

        // The drop is accounted for once the event boundary arrives.
        $this->assertSame([], $parser->feed("\n\n"));
        $this->assertSame(1, $parser->getDroppedEvents());
    }

    public function test_last_event_id_is_sticky_across_events(): void
    {
        $parser = new SseParser;

        $parser->feed("id: evt-1\ndata: one\n\n");
        $parser->feed("data: two\n\n");

        $this->assertSame('evt-1', $parser->getLastEventId());
    }

    public function test_data_value_without_leading_space_is_preserved(): void
    {
        $parser = new SseParser;

        $events = $parser->feed("data:{\"id\":1}\n\n");

        $this->assertCount(1, $events);
        $this->assertSame('{"id":1}', $events[0]->data);
    }
}
