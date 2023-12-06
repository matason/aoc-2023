<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day03;

final readonly class PartOne
{
    public function run(array $input): int
    {
        $maxX = mb_strlen($input[0]) - 1;
        $maxY = count($input) - 1;

        $isPointValid = function (int $x, int $y) use ($maxX, $maxY): bool {
            if ($x < 0 || $x > $maxX || $y < 0 || $y > $maxY) {
                return false;
            }

            return true;
        };

        $digitPoints  = [];
        foreach ($input as $y => $row) {
            $matches = [];
            $symbols = preg_match_all('/[^0-9.]+/', $row, $matches, PREG_OFFSET_CAPTURE);

            if (0 === $symbols || false === $symbols) {
                continue;
            }

            $symbolPoints = [];
            foreach ($matches[0] as $match) {
                $symbolPoints[] = new Point($match[1], $y, $match[0]);
            }

            foreach ($symbolPoints as $symbolPoint) {
                for ($relX = -1; $relX <= 1; $relX++) {
                    for ($relY = -1; $relY <= 1; $relY++) {
                        $pointX = $symbolPoint->x + $relX;
                        $pointY = $symbolPoint->y + $relY;

                        if (false === $isPointValid($pointX, $pointY)) {
                            continue;
                        }

                        if (is_numeric($value = $input[$pointY][$pointX])) {
                            $digitPoints[] = new Point($pointX, $pointY, $value);
                        }
                    }
                }
            }
        }

        foreach ($digitPoints as $digitPoint) {
            while (is_numeric($input[$digitPoint->y][$digitPoint->x - 1]) && $isPointValid($digitPoint->x - 1, $digitPoint->y)) {
                $digitPoint->x--;
            }

            $x = $digitPoint->x;
            $digitPoint->value = '';
            while ($isPointValid($x, $digitPoint->y) && is_numeric($input[$digitPoint->y][$x])) {
                $digitPoint->value .= (string) $input[$digitPoint->y][$x];
                $x++;
            }
        }

        $digits = array_unique($digitPoints);

        return array_sum(array_map(function (Point $digit): int {
            return (int) $digit->value;
        }, $digits));
    }
}
