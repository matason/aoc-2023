<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day03;

use Matason\AoC2023\Common\Point;

final readonly class PartTwo
{
    public function __construct(private array $input) {}

    public function run(): int
    {
        $symbolPoints = $this->getSymbolPoints();
        $digitPoints = $this->getDigitPoints($symbolPoints);
        $digits = $this->getDigits($digitPoints);

        return array_sum(array_map(function (array $symbolPoints): int {
            return (int) array_shift($symbolPoints)->value * (int) array_shift($symbolPoints)->value;
        }, $digits));
    }

    private function getSymbolPoints(): array
    {
        $symbolPoints = [];

        foreach ($this->input as $y => $row) {
            $matches = [];
            $symbols = preg_match_all('/[*]+/', $row, $matches, PREG_OFFSET_CAPTURE);
            if (0 === $symbols || false === $symbols) {
                continue;
            }

            foreach ($matches[0] as $match) {
                $symbolPoints[] = new Point($match[1], $y, $match[0]);
            }
        }

        return $symbolPoints;
    }

    private function getDigitPoints(array $symbolPoints): array
    {
        $digitPoints = [];

        foreach ($symbolPoints as $symbolPoint) {
            for ($relX = -1; $relX <= 1; $relX++) {
                for ($relY = -1; $relY <= 1; $relY++) {
                    if (0 === $relX && 0 === $relY) {
                        continue;
                    }

                    $pointX = $symbolPoint->x + $relX;
                    $pointY = $symbolPoint->y + $relY;

                    if (false === $this->isPointValid($pointX, $pointY)) {
                        continue;
                    }

                    if (is_numeric($value = $this->input[$pointY][$pointX])) {
                        $digitPoints[spl_object_hash($symbolPoint)][] = new Point($pointX, $pointY, $value);
                    }
                }
            }
        }

        return $digitPoints;
    }

    private function getDigits(array $digitPoints): array
    {
        foreach ($digitPoints as $symbolPoint => $digitPointCollection) {
            foreach ($digitPointCollection as $digitPoint) {
                while ($this->isPointValid($digitPoint->x - 1, $digitPoint->y) && is_numeric($this->input[$digitPoint->y][$digitPoint->x - 1])) {
                    $digitPoint->x--;
                }

                $x = $digitPoint->x;
                $digitPoint->value = '';
                while ($this->isPointValid($x, $digitPoint->y) && is_numeric($this->input[$digitPoint->y][$x])) {
                    $digitPoint->value .= (string) $this->input[$digitPoint->y][$x];
                    $x++;
                }
            }

            $digitPoints[$symbolPoint] = array_unique($digitPointCollection);

            if (count($digitPoints[$symbolPoint]) < 2) {
                unset($digitPoints[$symbolPoint]);
            }
        }

        return $digitPoints;
    }

    private function isPointValid(int $x, int $y): bool
    {
        $maxX = mb_strlen($this->input[0]) - 1;
        $maxY = count($this->input) - 1;

        if ($x < 0 || $x > $maxX || $y < 0 || $y > $maxY) {
            return false;
        }

        return true;
    }
}
