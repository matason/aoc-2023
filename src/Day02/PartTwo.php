<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day02;

final readonly class PartTwo
{
    public function run(array $input): int
    {
        return array_sum(array_map(function(string $game) {
            $totals = [
                'red' => 0,
                'green' => 0,
                'blue' => 0,
            ];

            $gameParts = explode(':', ltrim($game, 'Game '));

            foreach (explode(';', trim($gameParts[1])) as $handPlayed) {
                $cubes = explode(',', trim($handPlayed));

                foreach ($cubes as $cube) {
                    $cubeParts = explode(' ', trim($cube));

                    if ($totals[$cubeParts[1]] < (int) $cubeParts[0]) {
                        $totals[$cubeParts[1]] = (int) $cubeParts[0];
                    }
                }
            }

            return array_product($totals);
        }, $input));
    }
}
