<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day09;

final class SequenceSolver
{
    private array $stack;

    public function __construct(private readonly array $sequence) {
        $this->stack = [];
    }

    public function getNextInSequence(): int
    {
        $this->solve($this->sequence);

        $next = 0;
        while (count($this->stack) > 0) {
            $row = array_pop($this->stack);
            $next += array_pop($row);
        }

        return $next + $this->sequence[count($this->sequence) - 1];
    }

    public function getPreviousInSequence(): int
    {
        $this->solve($this->sequence);

        $previous = 0;
        while (count($this->stack) > 0) {
            $row = array_pop($this->stack);
            $previous = $row[0] - $previous;
        };

        return $this->sequence[0] - $previous;
    }

    private function solve(array $sequence): void
    {
        if ((1 === count($counts = array_count_values($sequence))) && array_key_exists(0, $counts)) {
            return;
        }

        $size = count($sequence);
        $row = [];
        for ($x = 0; $x < $size; $x++) {
            if (($x + 2) > $size) {
                $this->stack[] = $row;
                $this->solve($row);
                return;
            }

            $row[] = $sequence[$x + 1] - $sequence[$x];
        }
    }
}
