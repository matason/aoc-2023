<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day10;

use Matason\AoC2023\Common\Grid;
use Matason\AoC2023\Common\Point;

final class PartOne
{
    private Direction $direction;

    private readonly Grid $grid;

    public function run(array $input): int
    {
        $this->grid = new Grid($input);
        $this->direction = Direction::South;

        $startPoint = $currentPoint = [];
        foreach ($input as $y => $line) {
            if (false !== ($x = mb_strpos($line, 'S'))) {
                $startPoint = $currentPoint = new Point($x, $y, 'S');
                break;
            }
        }

        $steps = 0;
        do {
            $currentPoint = $this->move($currentPoint);
            $steps++;
        } while($currentPoint->x !== $startPoint->x || $currentPoint->y !== $startPoint->y);

        return $steps / 2;
    }

    public function move(Point $point): Point
    {
        switch ($this->direction) {
            case Direction::North:
                $adjacentPoint = Point::NORTH;
                break;

            case Direction::East:
                $adjacentPoint = Point::EAST;
                break;

            case Direction::South:
                $adjacentPoint = Point::SOUTH;
                break;

            case Direction::West:
                $adjacentPoint = Point::WEST;
                break;
        }

        if ($this->canMove($this->direction, $this->grid->getPointValue($point->x + $adjacentPoint[0], $point->y + $adjacentPoint[1]))) {
            $value = $this->grid->getPointValue($point->x + $adjacentPoint[0], $point->y + $adjacentPoint[1]);

            if (Direction::North === $this->direction && $value === '7') {
                $this->direction = Direction::West;
            } elseif (Direction::North === $this->direction && $value === 'F') {
                $this->direction = Direction::East;
            } elseif (Direction::East === $this->direction && $value === 'J') {
                $this->direction = Direction::North;
            } elseif (Direction::East === $this->direction && $value === '7') {
                $this->direction = Direction::South;
            } elseif (Direction::South === $this->direction && $value === 'J') {
                $this->direction = Direction::West;
            } elseif (Direction::South === $this->direction && $value === 'L') {
                $this->direction = Direction::East;
            } elseif (Direction::West === $this->direction && $value === 'L') {
                $this->direction = Direction::North;
            } elseif (Direction::West === $this->direction && $value === 'F') {
                $this->direction = Direction::South;
            }

            return new Point($point->x + $adjacentPoint[0], $point->y + $adjacentPoint[1], $value);
        }
    }

    private function canMove(Direction $direction, string $pipe): bool
    {
        if (Direction::North === $direction && in_array($pipe, ['|', '7', 'F'])) {
            return true;
        }

        if (Direction::East === $direction && in_array($pipe, ['-', 'J', '7'])) {
            return true;
        }

        if (Direction::South === $direction && in_array($pipe, ['|', 'L', 'J'])) {
            return true;
        }

        if (Direction::West === $direction && in_array($pipe, ['-', 'L', 'F'])) {
            return true;
        }

        if ('S' === $pipe) {
            return true;
        }

        return false;
    }
}
