<?php
declare(strict_types=1);

namespace Matason\AoC2023\Common;

final class Point
{
    // Moore neighbourhood points - x,y
    public const array MOORE_POINTS = [
        [-1, -1],
        [-1, 0],
        [-1, 1],
        [0, -1],
        [0, 1],
        [1, -1],
        [1, 0],
        [1, 1],
    ];

    // Von Neumann neighbourhood points - x,y
    public const array VON_NEUMANN_POINTS = [
        [0, -1],
        [1, 0],
        [0, 1],
        [-1, 0],
    ];

    public const array NORTH = [0, -1];

    public const array EAST = [1, 0];

    public const array SOUTH = [0, 1];

    public const array WEST = [-1, 0];

    public function __construct(public int $x, public int $y, public string $value) {}

    public function __toString(): string
    {
        return (string) $this->x . (string) $this->y . $this->value;
    }
}
