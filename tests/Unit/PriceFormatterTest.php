<?php

namespace Tests\Unit;

use App\Services\PriceFormatter;
use PHPUnit\Framework\TestCase;

class PriceFormatterTest extends TestCase
{
    private PriceFormatter $formatter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formatter = new PriceFormatter;
    }

    public function test_formats_fractional_prices_as_items_per_world_lock(): void
    {
        $this->assertSame('2/1 WL', $this->formatter->format('0.5'));
        $this->assertSame('4/1 WL', $this->formatter->format('0.25'));
        $this->assertSame('5/1 WL', $this->formatter->format('0.2'));
        $this->assertSame('10/1 WL', $this->formatter->format('0.1'));
        $this->assertSame('20/1 WL', $this->formatter->format('0.05'));
    }

    public function test_formats_non_integer_ratios_without_silent_rounding(): void
    {
        $this->assertSame('10/3 WL', $this->formatter->format('0.3'));
    }

    public function test_formats_zero(): void
    {
        $this->assertSame('0 WL', $this->formatter->format('0'));
        $this->assertSame('0 WL', $this->formatter->format('0.00000000'));
    }

    public function test_formats_normal_prices(): void
    {
        $this->assertSame('1 WL', $this->formatter->format('1'));
        $this->assertSame('10 WL', $this->formatter->format('10'));
        $this->assertSame('1,000 WL', $this->formatter->format('1000'));
        $this->assertSame('1.5 WL', $this->formatter->format('1.5'));
    }

    public function test_preserves_decimal_precision(): void
    {
        $this->assertSame('100000000/1 WL', $this->formatter->format('0.00000001'));
    }

    public function test_format_price_alias(): void
    {
        $this->assertSame('2/1 WL', $this->formatter->formatPrice('0.5'));
    }
}
