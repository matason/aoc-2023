<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use Matason\AoC2023\Day10\PartOne;
use Matason\AoC2023\Day10\PartTwo;

use function Matason\AoC2023\Common\getInputAsArray;

$input = getInputAsArray('/day10-input.txt');

print (string) (new PartOne())->run($input) . PHP_EOL;
print (string) (new PartTwo())->run($input) . PHP_EOL;

die(0);
