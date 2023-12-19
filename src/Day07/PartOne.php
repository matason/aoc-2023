<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day07;

final readonly class PartOne
{
    public function run(array $input): int
    {
        $hands = [];
        foreach ($input as $line) {
            list($cards, $bid) = explode(' ', $line);
            $hands[] = new Hand($cards, (int) $bid);
        }

        Sorta::mergeSort($hands, 0, count($hands) - 1);

        $total = 0;
        $size = count($hands);

        for ($x = 1; $x <= $size; $x++) {
            $total += $hands[$x - 1]->bid * $x;
        }

        return $total;
    }
}
