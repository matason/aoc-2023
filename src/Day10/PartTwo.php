<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day10;

use Matason\AoC2023\Common\Grid;
use Matason\AoC2023\Common\Point;
use Matason\AoC2023\Common\PointCollection;

final class PartTwo
{
    private Direction $direction;

    private readonly Grid $grid;

    public function run(array $input): int
    {
        $this->grid = new Grid($input);
        $this->direction = Direction::South;

        $startPoint = $currentPoint = [];
        foreach ($input as $row => $line) {
            if (false !== ($column = mb_strpos($line, 'S'))) {
                $startPoint = $currentPoint = new Point($column, $row, 'S');
                break;
            }
        }

        $points = [];
        do {
            $currentPoint = $this->move($currentPoint);
            $points[] = $currentPoint;
        } while($currentPoint->x !== $startPoint->x || $currentPoint->y !== $startPoint->y);

        $pointCollection = new PointCollection($points);
        $enclosedPoints = 0;
        for ($row = 0; $row < $this->grid->height; $row++) {
            for ($column = 0; $column <= $this->grid->width; $column++) {
                if (null === $pointCollection->hasPoint($column, $row)) {
                    continue;
                }

                $boundariesCrossed = 0;
                $enclosedPointCounter = 0;

                for ($currentLineColumn = $column; $currentLineColumn <= $this->grid->width; $currentLineColumn++) {
                    $point = $pointCollection->hasPoint($currentLineColumn, $row);
                    if ($point instanceof Point && in_array($point->value, ['|', 'J', 'L'])) {
                        $boundariesCrossed++;
                    } elseif ($point instanceof Point) {
                        continue;
                    } elseif (0 !== $boundariesCrossed % 2) {
                        $enclosedPointCounter++;
                    }
                }

                if ($boundariesCrossed > 0 && 0 === $boundariesCrossed % 2) {
                    $enclosedPoints += $enclosedPointCounter;
                }

                break;
            }
        }

        return $enclosedPoints;
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
