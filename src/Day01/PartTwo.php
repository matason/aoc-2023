<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day01;

final readonly class PartTwo
{
    public function run(array $input): int
    {
        return array_sum(array_map(function($line) {
            return (new Line($line))->process();
        }, $input));
    }
}
