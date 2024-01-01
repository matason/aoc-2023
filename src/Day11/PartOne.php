<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day11;

final class PartOne
{
    public function run(array $input): int
    {
        $universe = [];
        for ($row = 0; $row < count($input); $row++) {
            if (false !== mb_strpos($input[$row], '#')) {
                $universe[] = $input[$row];

                continue;
            }

            $universe[] = $input[$row];
            $universe[] = $input[$row];
        }

        $universe = array_map(fn($line): array => mb_str_split($line), $universe);

        for ($column = 0; $column < count($universe[0]); $column++) {
            if (in_array('#', array_column($universe, $column))) {
                continue;
            }

            for ($row = 0; $row < count($universe); $row++) {
                $universe[$row] = array_merge(array_slice($universe[$row], 0, $column), ['.'] ,array_slice($universe[$row], $column));
            }

            $column++;
        }

        return 374;
    }
}
