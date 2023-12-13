<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day05;

use ArrayIterator;

final readonly class PartTwo
{
    public function run(array $input): int
    {
        $ranges = $this->buildranges($input[0]);
        $maps = $this->buildMaps(array_slice($input, 1));
        $results = [];

        foreach ($ranges as $range) {
            $range = new ArrayIterator([$range]);
            foreach ($maps as $name => $transitionMappings) {
                $mapped = new ArrayIterator([]);
                foreach ($transitionMappings as $map) {
                    $unmapped = new ArrayIterator([]);
                    while ($range->valid()) {
                        $processedRange = $map->processRange($range->current());

                        if (array_key_exists(Map::INTERSECTION, $processedRange)) {
                            $mapped->append($processedRange[Map::INTERSECTION]);
                        }

                        if (array_key_exists(Map::MISS, $processedRange)) {
                            $unmapped->append($processedRange[Map::MISS]);
                        }
                        if (array_key_exists(Map::DIFFERENCE, $processedRange)) {

                            foreach ($processedRange[Map::DIFFERENCE] as $difference) {
                                $unmapped->append($difference);
                            }
                        }

                        $range->next();
                    }

                    $range = $unmapped;
                }

                $range = $mapped;

                foreach ($unmapped->getArrayCopy() as $unmappedRange) {
                    $range->append($unmappedRange);
                }
            }

            foreach ($unmapped->getArrayCopy() as $unmappedRange) {
                $mapped->append($unmappedRange);
            }

            $results = array_merge($results, $mapped->getArrayCopy());
        }

        $result = array_reduce($results, function(Range $a, Range $b): Range {
            if ($a->from < $b->from) {
                return $a;
            }
            return $b;
        }, $results[0]);


        return $result->from;
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
