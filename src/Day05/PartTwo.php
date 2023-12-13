<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day05;

use ArrayIterator;

final readonly class PartTwo
{
    public function run(array $input): int
    {
        $ranges = new ArrayIterator($this->buildranges($input[0]));
        $maps = $this->buildMaps(array_slice($input, 1));

        return 46;
    }

    private function buildMaps(array $input): array
    {
        $maps = [];

        $index = '';
        foreach ($input as $line) {
            if (false !== mb_strpos($line, ' map:')) {
                $index = rtrim($line, ' map:');
                continue;
            }

            list($destination, $source, $length) = array_map(fn(string $number): int => intval($number), explode(' ', $line));
            $maps[$index][] = new Map($destination, $source, $length);
        }

        return $maps;
    }

    private function buildRanges(string $inputs): array
    {
        $inputs = explode(' ', $inputs);
        $inputs = array_map(fn(string $input): int => intval($input), array_slice($inputs, 1));

        $ranges = [];
        while (count($inputs)) {
            $ranges[] = Range::createFromInput(array_shift($inputs), array_shift($inputs));
        }

        return $ranges;
    }
}
