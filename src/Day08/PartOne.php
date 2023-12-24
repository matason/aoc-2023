<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day08;

final readonly class PartOne
{
    public function run(array $input): int
    {
        $iritator = new Iritator(mb_str_split(array_shift($input)));

        $maps = [];
        foreach ($input as $map) {
            $index = $map[0] . $map[1] . $map[2];
            $l = $map[7] . $map[8] . $map[9];
            $r = $map[12] . $map[13] . $map[14];

            $maps[$index] = ['L' => $l, 'R' => $r];
        }

        $pos = 'AAA';
        $steps = 0;
        while ('ZZZ' !== $pos) {
            $pos = $maps[$pos][$iritator->current()];
            $iritator->next();
            $steps++;
        }

        return $steps;
    }
}
