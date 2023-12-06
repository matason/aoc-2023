<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day04;

final readonly class PartOne
{
    public function run(array $input): int
    {
        $i = 0;
        return array_sum(array_map(function(string $card) use ($i): int {
            $i++;
            $card = str_replace(['Card ' . (string) $i . ': ', ' | '], ['', '|'], $card);
            $cardParts = explode('|', $card);

            $drawn = array_filter(explode(' ', $cardParts[0]));
            $chosen = array_filter(explode(' ', $cardParts[1]));
            $winningNumbers = array_intersect($drawn, $chosen);
            $numbers = count($winningNumbers);

            if ($numbers < 3) {
                return (int) $numbers;
            }

            return (int) pow(2, ($numbers - 1));
        }, $input));
    }
}
