<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day05;

final class Map
{
    public const string INTERSECTION = 'intersection';

    public const string DIFFERENCE = 'difference';

    public const string MISS = 'miss';

    private int $offset = 0;

    private int $from = 0;

    private int $to = 0;

    public function __construct(int $destination, int $source, int $length) {
        $this->offset = $destination - $source;
        $this->from = $source;
        $this->to = $source + ($length - 1);
    }

    public function getDestination(int $source): int
    {
        if ($source >= $this->from && $source <= $this->to) {
            return $source + $this->offset;
        }

        return $source;
    }

    public function processRange(Range $range): array
    {
        // Map encompasses range.
        if ($range->from >= $this->from && $range->to <= $this->to) {
            return [
                self::INTERSECTION => Range::createFromPair($range->from + $this->offset, $range->to + $this->offset),
            ];
        }

        // Range encompasses map.
        if ($range->from < $this->from && $range->to > $this->to) {
            return [
                self::INTERSECTION => Range::createFromPair($this->from + $this->offset, $this->to + $this->offset),
                self::DIFFERENCE => [
                    Range::createFromPair($range->from, ($this->from - 1)),
                    Range::createFromPair(($this->to + 1), $range->to),
                ],
            ];
        }

        // Range overlaps low end of the map.
        if ($range->from <= $this->from && $range->to >= $this->from) {
            return [
                self::INTERSECTION => Range::createFromPair($this->from + $this->offset, $range->to + $this->offset),
                self::DIFFERENCE => [
                    Range::createFromPair($range->from, ($this->from - 1)),
                ],
            ];
        }

        // Range overlaps high end of the map.
        if ($range->from <= $this->to && $range->to >= $this->to) {
            return [
                self::INTERSECTION => Range::createFromPair($range->from + $this->offset, $this->to + $this->offset),
                self::DIFFERENCE => [
                    Range::createFromPair(($this->to + 1), $range->to),
                ],
            ];
        }

        return [self::MISS => $range];
    }

    public function __toString(): string
    {
        return sprintf('From %d to %d', $this->from, $this->to);
    }
}
