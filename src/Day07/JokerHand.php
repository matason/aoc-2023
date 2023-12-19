<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day07;

final class JokerHand
{
    private const int FIVE_OF_A_KIND = 100;

    private const int FOUR_OF_A_KIND = 90;

    private const int FULL_HOUSE = 80;

    private const int THREE_OF_A_KIND = 70;

    private const int TWO_PAIR = 60;

    private const int ONE_PAIR = 50;

    private const int HIGH_CARD = 40;

    private array $indexedCards;

    private readonly array $groupedCards;

    private readonly int $jokers;

    public function __construct(public readonly string $cards, public readonly int $bid) {
        $this->groupedCards = count_chars($cards, 1);

        $this->jokers = $this->groupedCards[74] ?? 0;

        $this->indexedCards = array_map(fn(string $value): int => match ($value) {
            'A' => 14,
            'K' => 13,
            'Q' => 12,
            'J' => 11,
            'T' => 10,
            default => (int) $value,
        }, mb_str_split($cards));

        $this->calculateHandType();
    } 

    private function calculateHandType(): void
    {
        if ($this->isFiveOfAKind()) {
            array_unshift($this->indexedCards, self::FIVE_OF_A_KIND);

            return;
        }

        if ($this->isFourOfAKind()) {
            $value = self::FOUR_OF_A_KIND;

            if (1 === $this->jokers || 4 === $this->jokers) {
                $value = self::FIVE_OF_A_KIND;
            }

            array_unshift($this->indexedCards, $value);

            return;
        }

        if ($this->isFullHouse()) {
            $value = self::FULL_HOUSE;

            if (2 === $this->jokers || 3 === $this->jokers) {
                $value = self::FIVE_OF_A_KIND;
            }

            array_unshift($this->indexedCards, $value);

            return;
        }

        if ($this->isThreeOfAKind()) {
            $value = self::THREE_OF_A_KIND;

            if (1 === $this->jokers || 3 === $this->jokers) {
                $value = self::FOUR_OF_A_KIND;
            }

            array_unshift($this->indexedCards, $value);

            return;
        }

        if ($this->isTwoPair()) {
            $value = self::TWO_PAIR;

            if (1 === $this->jokers) {
                $value = self::FULL_HOUSE;
            } elseif (2 === $this->jokers) {
                $value = self::FOUR_OF_A_KIND;
            }

            array_unshift($this->indexedCards, $value);

            return;
        }

        if ($this->isOnePair()) {
            $value = self::ONE_PAIR;

            if (1 === $this->jokers || 2 === $this->jokers) {
                $value = self::THREE_OF_A_KIND;
            }

            array_unshift($this->indexedCards, $value);

            return;
        }

        if (1 === $this->jokers) {
            array_unshift($this->indexedCards, self::ONE_PAIR);

            return;
        }

        array_unshift($this->indexedCards, self::HIGH_CARD);
    }

    public function isFiveOfAKind(): bool
    {
        return 1 === count($this->groupedCards, 1);
    }

    public function isFourOfAKind(): bool
    {
        if (2 === count($this->groupedCards) && in_array(4, $this->groupedCards)) {
            return true;
        }

        return false;
    }

    public function isFullHouse(): bool
    {
        if (2 === count($this->groupedCards) && in_array(2, $this->groupedCards) && in_array(3, $this->groupedCards)) {
            return true;
        }

        return false;
    }

    public function isThreeOfAKind(): bool
    {
        if (3 === count($this->groupedCards) && in_array(3, $this->groupedCards) && false === in_array(2, $this->groupedCards)) {
            return true;
        }

        return false;
    }

    public function isTwoPair(): bool
    {
        $countedValues = array_count_values($this->groupedCards);
        if (3 === count($this->groupedCards) && array_key_exists(2, $countedValues) && 2 === $countedValues[2]) {
            return true;
        }

        return false;
    }

    public function isOnePair(): bool
    {
        $countedValues = array_count_values($this->groupedCards);
        if (4 === count($this->groupedCards) && array_key_exists(2, $countedValues) && 1 === $countedValues[2]) {
            return true;
        }

        return false;
    }

    public function getIndexedCards(): array
    {
        $data = $this->indexedCards;

        if ($this->jokers > 0) {
            $data = array_map(function ($value): int {
                if (11 === $value) {
                    $value = 1;
                }

                return $value;
            }, $data);
        }

        return $data;
    }

    public function __toString(): string
    {
        return $this->cards;
    }
}
