<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day09;

final readonly class PartOne
{
    public function run(array $input): int
    {
        $predictions = array_map(function($line) {
            $sequence = new SequenceSolver(explode(' ', $line));
            return $sequence->getNextInSequence();
        }, $input);

        return array_sum($predictions);
    }
}
