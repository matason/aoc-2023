<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day06;

final readonly class PartTwo
{
    public function run(array $input): int
    {
        $duration = (int) str_replace(' ', '', ltrim($input[0], 'Time:'));
        $distance = (int) str_replace(' ', '', ltrim($input[1], 'Distance:'));

        $race = fn(int $value, int $duration, int $threshold): bool => ($value * ($duration - $value)) > $threshold;

        $wins = 0;
        $l = $r = (int) floor($duration / 2);

        while($race($r, $duration, $distance)) {
            $wins++;
            $r++;
        }

        $l--;
        while($race($l, $duration, $distance)) {
            $wins++;
            $l--;
        }

        return $wins;
    }
}
