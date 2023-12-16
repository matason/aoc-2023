<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day06;

final readonly class PartOne
{
    public function run(array $input): int
    {
        $duration = array_map(fn(string $value): int => intval($value), array_values(array_filter(explode(' ', ltrim($input[0], 'Time:')))));
        $distance = array_map(fn(string $value): int => intval($value), array_values(array_filter(explode(' ', ltrim($input[1], 'Distance:')))));

        $race = fn(int $value, int $duration, int $threshold): bool => ($value * ($duration - $value)) > $threshold;

        $total = [];
        $wins = 0;

        $size = count($duration);
        for ($x = 0; $x < $size; $x++) {
            $l = $r = (int) floor($duration[$x] / 2);

            while($race($r, $duration[$x], $distance[$x])) {
                $wins++;
                $r++;
            }

            $l--;
            while($race($l, $duration[$x], $distance[$x])) {
                $wins++;
                $l--;
            }

            $total[] = $wins;
            $wins = 0;
        }

        return array_product($total);
    }
}
