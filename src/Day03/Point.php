<?php

namespace Matason\AoC2023\Day03;
final class Point
{
    public function __construct(public int $x, public int $y, public string $value) {}

    public function __toString(): string
    {
        return (string) $this->x . (string) $this->y . $this->value;
    }
}
