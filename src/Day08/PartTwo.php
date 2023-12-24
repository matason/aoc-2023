<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day08;

final readonly class PartTwo
{
    public function run(array $input): int
    {
        $iritator = new Iritator(mb_str_split(array_shift($input)));

        $maps = [];
        $startNodes = [];
        foreach ($input as $map) {
            $index = $map[0] . $map[1] . $map[2];
            $l = $map[7] . $map[8] . $map[9];
            $r = $map[12] . $map[13] . $map[14];

            $maps[$index] = ['L' => $l, 'R' => $r];

            if ('A' === $map[2]) {
                $startNodes[] = $index;
            }
        }

        $steps = 0;
        $arrived = false;
        $endNodes = [];
        while (false === $arrived) {
            $move = $iritator->current();
            $steps++;
            $thisMove = [];
            foreach ($startNodes as $i => $startNode) {
                $thisMove[] = $maps[$startNode][$move];
                if ('Z' === $maps[$startNode][$move][2]) {
                    $endNodes[$i] = $steps;
                }
            }
            $iritator->next();

            if (count($endNodes) === count($startNodes)) {
                $arrived = true;
            }

            $startNodes = $thisMove;
        }

        rsort($endNodes, SORT_NUMERIC);
        $endNodesIterator = new Iritator($endNodes);

        $lcm = function($a, $b): int {
            $max = max($a, $b);
            $min = min($a, $b);
            $multiple = $max;
            while ($multiple % $min !== 0) {
                $multiple += $max;
            }

            return $multiple;
        };

        while (1 !== count(array_count_values($endNodesIterator->toArray()))) {
            $key = $endNodesIterator->key();
            $a = $endNodesIterator->current();
            $endNodesIterator->next();
            $b = $endNodesIterator->current();

            $endNodesIterator->toArray()[$key] = $lcm($a, $b);
        }

        $endNodesIterator->rewind();

        return $endNodesIterator->current();
    }
}
