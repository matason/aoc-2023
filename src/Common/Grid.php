<?php
declare(strict_types=1);

namespace Matason\AoC2023\Common;

final readonly class Grid
{
    public int $width;

    public int $height;

    public function __construct(private array $data)
    {
        $this->width = strlen($data[0]) - 1;
        $this->height = count($data) - 1;
    }

    public function getPointValue(int $x, int $y): mixed {
        if ($this->isPointValid($x, $y)) {
            return $this->data[$y][$x];
        }

        return '.';
    }

    public function isPointValid(int $x, int $y): bool
    {
        if ($x < 0 || $x > $this->width || $y < 0 || $y > $this->height) {
            return false;
        }

        return true;
    }

    public function getArea(): int
    {
        return $this->height * $this->width;
    }
}
