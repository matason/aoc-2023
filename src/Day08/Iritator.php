<?php
declare(strict_types=1);

namespace Matason\AoC2023\Day08;

final class Iritator implements \Iterator
{
    private int $position = 0;

    private int $count = 0;

    public function __construct(private readonly array $data) {
        $this->count = count($data);
    }

    #[\Override] public function current(): mixed
    {
        return $this->data[$this->position];
    }

    #[\Override] public function next(): void
    {
        if ($this->position < ($this->count - 1)) {
            ++$this->position;
        } else {
            $this->position = 0;
        }
    }

    #[\Override] public function key(): mixed
    {
        return $this->position;
    }

    #[\Override] public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    #[\Override] public function rewind(): void
    {
        $this->position = 0;
    }
}
