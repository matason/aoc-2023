<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day02\PartOne;
use Matason\AoC2023\Day02\PartTwo;

final class Day02Test extends TestCase
{
    #[DataProvider('inputProvider')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(8, (new PartOne())->run($input));
    }

    #[DataProvider('inputProvider')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(2286, (new PartTwo())->run($input));
    }

    public static function inputProvider(): array
    {
        $input = <<<EOD
Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green
EOD;

        return [[array_filter(explode("\n", $input))]];
    }

    public static function part2InputProvider(): array
    {
        $input = <<<EOD
two1nine
eightwothree
abcone2threexyz
xtwone3four
4nineeightseven2
zoneight234
7pqrstsixteen
EOD;
        return [[array_filter(explode("\n", $input))]];
    }
}
