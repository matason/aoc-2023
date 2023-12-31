<?php
declare(strict_types=1);

namespace Matason\AoC2023\Common;

final readonly class PointCollection
{
    public function __construct(private array $points) {}

    public function hasPoint(int $x, int $y): ?Point
    {
        foreach ($this->points as $point) {
            if ($point->x === $x && $point->y === $y) {
                return $point;
            }
        }

        return null;
    }
}
