<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day10\PartOne;
use Matason\AoC2023\Day10\PartTwo;

final class Day10Test extends TestCase
{
    #[DataProvider('inputProviderPartOne')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(8, (new PartOne())->run($input));
    }

    #[DataProvider('inputProviderPartTwo')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(10, (new PartTwo())->run($input));
    }

    public static function inputProviderPartOne(): array
    {
        $input = <<<EOD
..F7.
.FJ|.
SJ.L7
|F--J
LJ...
EOD;

        return [[array_filter(explode("\n", $input))]];
    }

    public static function inputProviderPartTwo(): array
    {
        $input = <<<EOD
FF7FSF7F7F7F7F7F---7
L|LJ||||||||||||F--J
FL-7LJLJ||||||LJL-77
F--JF--7||LJLJ7F7FJ-
L---JF-JLJ.||-FJLJJ7
|F|F-JF---7F7-L7L|7|
|FFJF7L7F-JF7|JL---7
7-L-JL7||F7|L7F-7F7|
L.L7LFJ|||||FJL7||LJ
L7JLJL-JLJLJL--JLJ.L
EOD;

        return [[array_filter(explode("\n", $input))]];
    }
}
