<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day01;

final readonly class PartOne
{
    public function run(array $input): int
    {
        return array_sum(array_map(function($line) {
            $line = preg_replace('/[a-z]/i', '', $line);

            if (1 === mb_strlen($line)) {
                return (int) ($line . $line);
            }

            return (int) ($line[0] . ($line[mb_strlen($line) - 1]));
        }, $input));
    }
}
