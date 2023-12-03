<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day01\PartOne;
use Matason\AoC2023\Day01\PartTwo;

final class Day01Test extends TestCase
{
    #[DataProvider('part1InputProvider')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(142, (new PartOne())->run($input));
    }

    #[DataProvider('part2InputProvider')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(281, (new PartTwo())->run($input));
    }

    public static function part1InputProvider(): array
    {
        $input = <<<EOD
1abc2
pqr3stu8vwx
a1b2c3d4e5f
treb7uchet
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
