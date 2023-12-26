<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use Matason\AoC2023\Day09\PartOne;
use Matason\AoC2023\Day09\PartTwo;

use function Matason\AoC2023\Common\getInputAsArray;

$input = getInputAsArray('/day09-input.txt');

print (string) (new PartOne())->run($input) . PHP_EOL;
print (string) (new PartTwo())->run($input) . PHP_EOL;

die(0);
