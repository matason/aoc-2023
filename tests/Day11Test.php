<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day11\PartOne;
use Matason\AoC2023\Day11\PartTwo;

final class Day11Test extends TestCase
{
    #[DataProvider('inputProviderPartOne')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(374, (new PartOne())->run($input));
    }

    #[DataProvider('inputProviderPartTwo')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(0, (new PartTwo())->run($input));
    }

    public static function inputProviderPartOne(): array
    {
        $input = <<<EOD
...#......
.......#..
#.........
..........
......#...
.#........
.........#
..........
.......#..
#...#.....
EOD;

        return [[array_filter(explode("\n", $input))]];
    }

    public static function inputProviderPartTwo(): array
    {
        $input = <<<EOD
EOD;

        return [[array_filter(explode("\n", $input))]];
    }
}
