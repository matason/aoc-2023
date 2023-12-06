<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day03\PartOne;
use Matason\AoC2023\Day03\PartTwo;

final class Day03Test extends TestCase
{
    #[DataProvider('inputProvider')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(4361, (new PartOne())->run($input));
    }

    #[DataProvider('inputProvider')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(467835 , (new PartTwo($input))->run());
    }

    public static function inputProvider(): array
    {
        $input = <<<EOD
467..114..
...*......
..35..633.
......#...
617*......
.....+.58.
..592.....
......755.
...$.*....
.664.598..
EOD;

        return [[array_filter(explode("\n", $input))]];
    }
}
