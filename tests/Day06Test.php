<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day06\PartOne;
use Matason\AoC2023\Day06\PartTwo;

final class Day06Test extends TestCase
{
    #[DataProvider('inputProvider')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(288, (new PartOne())->run($input));
    }

    #[DataProvider('inputProvider')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(71503 , (new PartTwo())->run($input));
    }

    public static function inputProvider(): array
    {
        $input = <<<EOD
Time:      7  15   30
Distance:  9  40  200
EOD;

        return [[array_filter(explode("\n", $input))]];
    }
}
