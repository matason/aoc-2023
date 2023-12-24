<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day08\PartOne;
use Matason\AoC2023\Day08\PartTwo;

final class Day08Test extends TestCase
{
    #[DataProvider('inputProviderPartOne')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(6, (new PartOne())->run($input));
    }

    #[DataProvider('inputProviderPartTwo')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(6, (new PartTwo())->run($input));
    }

    public static function inputProviderPartOne(): array
    {
        $input = <<<EOD
LLR

AAA = (BBB, BBB)
BBB = (AAA, ZZZ)
ZZZ = (ZZZ, ZZZ)
EOD;

        return [[array_filter(explode("\n", $input))]];
    }

    public static function inputProviderPartTwo(): array
    {
        $input = <<<EOD
LR

11A = (11B, XXX)
11B = (XXX, 11Z)
11Z = (11B, XXX)
22A = (22B, XXX)
22B = (22C, 22C)
22C = (22Z, 22Z)
22Z = (22B, 22B)
XXX = (XXX, XXX)
EOD;

        return [[array_filter(explode("\n", $input))]];
    }
}
