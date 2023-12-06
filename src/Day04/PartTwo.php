<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day04;

final readonly class PartTwo
{
    public function run(array $input): int
    {
        $cardsWon = [];

        foreach ($input as $i => $card) {
            $i++;
            $card = str_replace(['Card ' . (string) $i . ': ', ' | '], ['', '|'], $card);
            $cardParts = explode('|', $card);

            $drawn = array_filter(explode(' ', $cardParts[0]));
            $chosen = array_filter(explode(' ', $cardParts[1]));
            $winningNumbers = array_intersect($drawn, $chosen);
            $numbers = count($winningNumbers);

            if (array_key_exists($i, $cardsWon)) {
                $cardsWon[$i]++;
            } else {
                $cardsWon[$i] = 1;
            }

            if (0 === $numbers) {
                continue;
            }

            $currentCardCount = $cardsWon[$i];
            for ($x = ($i + 1); $x <= ($numbers + $i); $x++) {
                if (array_key_exists($x, $cardsWon)) {
                    $cardsWon[$x] += (1 * $currentCardCount);
                } else {
                    $cardsWon[$x] = (1 * $currentCardCount);
                }
            }
        }

        return array_sum($cardsWon);
    }
}
