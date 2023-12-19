<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day07;

final readonly class Sorta
{
    public static function mergeSort(array &$data, int $start, int $end): void
    {
        if ($start < $end) {
            $mid = (int) floor(($start + $end) / 2);

            Sorta::mergeSort($data, $start, $mid);
            Sorta::mergeSort($data, $mid + 1, $end);
            Sorta::merge($data, $start, $mid, $end);
        }
    }

    private static function merge(array &$data, int $start, int $mid, int $end): void
    {
        $tmp = [];
        $i = $start;
        $j = $mid + 1;
        $k = 0;

        while ($i <= $mid && $j <= $end) {
            for ($pos = 0; $pos <= 5; $pos++) {
                $left = $data[$i]->getIndexedCards();
                $right = $data[$j]->getIndexedCards();

                if ($left[$pos] === $right[$pos]) {
                    continue;
                }

                if ($left[$pos] < $right[$pos]) {
                    $tmp[$k++] = $data[$i++];
                } else {
                    $tmp[$k++] = $data[$j++];
                }

                break;
            }
        }

        while ($i <= $mid) {
            $tmp[$k++] = $data[$i++];
        }

        while ($j <= $end) {
            $tmp[$k++] = $data[$j++];
        }

        for ($i = $start; $i <= $end; $i++) {
            $data[$i] = $tmp[$i - $start];
        }
    }
}
