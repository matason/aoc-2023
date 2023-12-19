<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day07\PartOne;
use Matason\AoC2023\Day07\PartTwo;

final class Day07Test extends TestCase
{
    #[DataProvider('inputProvider')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(6440, (new PartOne())->run($input));
    }

    #[DataProvider('inputProvider')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(5905, (new PartTwo())->run($input));
    }

    public static function inputProvider(): array
    {
        $input = <<<EOD
32T3K 765
T55J5 684
KK677 28
KTJJT 220
QQQJA 483
EOD;

        return [[array_filter(explode("\n", $input))]];
    }
}
