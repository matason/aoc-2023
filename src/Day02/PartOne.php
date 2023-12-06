<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day02;

final readonly class PartOne
{
    private const array MAP = [
        'red' => 12,
        'green' => 13,
        'blue' => 14,
    ];

    public function run(array $input): int
    {
        return array_sum(array_map(function(string $game) {
            $gameParts = explode(':', ltrim($game, 'Game '));

            foreach(explode(';', trim($gameParts[1])) as $handPlayed) {
                $cubes = explode(',', trim($handPlayed));

                foreach ($cubes as $cube) {
                    $cubeParts = explode(' ', trim($cube));

                    if ((int) $cubeParts[0] > self::MAP[$cubeParts[1]]) {
                        return 0;
                    }
                }
            }

            return (int) $gameParts[0];
        }, $input));
    }
}
