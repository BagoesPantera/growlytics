<?php

namespace App\Services;

use Brick\Math\BigDecimal;
use Brick\Math\BigRational;

class PriceFormatter
{
    public function format(mixed $price): string
    {
        return $this->formatPrice($price);
    }

    public function formatPrice(mixed $price): string
    {
        $decimal = $price instanceof BigDecimal ? $price : BigDecimal::of($price);

        if ($decimal->isZero()) {
            return '0 WL';
        }

        if ($decimal->isGreaterThanOrEqualTo(BigDecimal::one())) {
            return $this->formatDecimal($decimal).' WL';
        }

        $ratio = BigRational::one()->dividedBy(BigRational::of($decimal));

        return $ratio->getNumerator()->toString().'/'.$ratio->getDenominator()->toString().' WL';
    }

    public function formatPriceWl(mixed $price): string
    {
        return $this->formatPrice($price);
    }

    private function formatDecimal(BigDecimal $price): string
    {
        $value = $price->strippedOfTrailingZeros()->toString();

        if (str_contains($value, '.')) {
            [$integer, $fraction] = explode('.', $value, 2);
        } else {
            $integer = $value;
            $fraction = '';
        }

        $sign = '';

        if (str_starts_with($integer, '-')) {
            $sign = '-';
            $integer = substr($integer, 1);
        }

        $grouped = preg_replace('/\B(?=(\d{3})+$)/', ',', $integer) ?? $integer;
        $result = $sign.$grouped;

        if ($fraction !== '') {
            $result .= '.'.$fraction;
        }

        return $result;
    }
}
