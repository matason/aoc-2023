<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day01;

final class Line
{
    public const array MAP = [
        LineDirection::forward->name => [
            'o' => [
                'one' => 1
            ],
            't' => [
                'two' => 2,
                'three' => 3,
            ],
            'f' => [
                'four' => 4,
                'five' => 5,
            ],
            's' => [
                'six' => 6,
                'seven' => 7,
            ],
            'e' => [
                'eight' => 8,
            ],
            'n' => [
                'nine' => 9,
            ],
        ],
        LineDirection::reverse->name => [
            'e' => [
                'eno' => 1,
                'eerht' => 3,
                'evif' => 5,
                'enin' => 9,
            ],
            'o' => [
                'owt' => 2,
            ],
            'r' => [
                'ruof' => 4,
            ],
            'x' => [
                'xis' => 6,
            ],
            'n' => [
                'neves' => 7,
            ],
            't' => [
                'thgie' => 8,
            ]
        ],
    ];

    private LineDirection $direction = LineDirection::forward;

    private int $pointer = 0;

    private string $result = '';

    public function __construct(private string $line) {}

    public function process(): int
    {
        if ($this->hasResult() || $this->eol()) {
            return $this->getResult();
        }

        $character = $this->line[$this->pointer];

        if (is_numeric($character)) {
            $this->result .= (string) $character;
            $this->reverseDirection();
            return $this->process();
        }

        if (false === array_key_exists($character, self::MAP[$this->direction->name])) {
            $this->pointer++;
            return $this->process();
        }

        foreach (self::MAP[$this->direction->name][$character] as $word => $value) {
            if (str_starts_with(mb_substr($this->line, $this->pointer), $word)) {
                $this->result .= (string) $value;
                $this->reverseDirection();
                return $this->process();
            }
        }

        $this->pointer++;
        return $this->process();
    }

    private function hasResult(): bool
    {
        if (2 === mb_strlen($this->result)) {
            return true;
        }

        if (0 === mb_strlen($this->line)) {
            return true;
        }

        return false;
    }

    private function getResult(): int
    {
        if (1 === mb_strlen($this->result)) {
            return (int) ($this->result . $this->result);
        }

        if (2 === mb_strlen($this->result)) {
            return (int) $this->result;
        }

        print sprintf('Expected result length of 1 or 2 characters, actual result length is %s character(s).', mb_strlen($this->result));
        die(1);
    }

    private function reverseDirection(): void
    {
        $this->line = strrev($this->line);
        $this->direction = LineDirection::reverse;
        $this->pointer = 0;
    }
    private function eol(): bool
    {
        return $this->pointer === mb_strlen($this->line);
    }
}
