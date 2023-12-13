<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day05;

final readonly class PartOne
{
    public function run(array $input): int
    {
        $sources = $this->getSources($input[0]);
        $mapCollection = $this->buildMaps(array_slice($input, 1));

        foreach ($sources as &$source) {
            foreach ($mapCollection as $maps) {
                foreach ($maps as $map) {
                    $destination = $map->getDestination($source);
                    if ($destination !== $source) {
                        $source = $destination;
                        break;
                    }
                }
            }

            unset($source);
        }

        return min($sources);
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

    private function getSources(string $sources): array
    {
        $sources = explode(' ', $sources);

        return array_map(fn(string $source): int => intval($source), array_slice($sources, 1));
    }
}
