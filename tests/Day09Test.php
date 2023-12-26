<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Matason\AoC2023\Day09\PartOne;
use Matason\AoC2023\Day09\PartTwo;

final class Day09Test extends TestCase
{
    #[DataProvider('inputProvider')]
    public function testPartOne(array $input): void
    {
        $this->assertSame(114, (new PartOne())->run($input));
    }

    #[DataProvider('inputProvider')]
    public function testPartTwo(array $input): void
    {
        $this->assertSame(2, (new PartTwo())->run($input));
    }

    public static function inputProvider(): array
    {
        $input = <<<EOD
0 3 6 9 12 15
1 3 6 10 15 21
10 13 16 21 30 45
EOD;

        return [[array_filter(explode("\n", $input))]];
    }
}
