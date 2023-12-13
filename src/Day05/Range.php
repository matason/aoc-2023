<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day05;

final readonly class Range
{
    public function __construct(public int $from, public int $to) {}

    public static function createFromInput(int $from, int $length): self
    {
        return new self($from, ($from + ($length - 1)));
    }

    public static function createFromPair(int $from, int $to): self
    {
        return new self($from, $to);
    }

    public function __toString(): string
    {
        return sprintf('From %d to %d', $this->from, $this->to);
    }
}
