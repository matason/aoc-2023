<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day08\PartOne;
use Matason\AoC2023\Day08\PartTwo;

final class Day08Test extends TestCase
{
    #[DataProvider('inputProvider')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(6, (new PartOne())->run($input));
    }

    #[DataProvider('inputProvider')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(0, (new PartTwo())->run($input));
    }

    public static function inputProvider(): array
    {
        $input = <<<EOD
LLR

AAA = (BBB, BBB)
BBB = (AAA, ZZZ)
ZZZ = (ZZZ, ZZZ)
EOD;

        return [[array_filter(explode("\n", $input))]];
    }
}
