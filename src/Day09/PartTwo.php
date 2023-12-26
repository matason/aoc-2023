<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day09;

final readonly class PartTwo
{
    public function run(array $input): int
    {
        $predictions = array_map(function($line) {
            $sequence = new SequenceSolver(explode(' ', $line));
            return $sequence->getPreviousInSequence();
        }, $input);

        return array_sum($predictions);
    }
}
