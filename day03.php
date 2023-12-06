<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use Matason\AoC2023\Day03\PartOne;
use Matason\AoC2023\Day03\PartTwo;

use function Matason\AoC2023\Common\getInputAsArray;

$input = getInputAsArray('/day03-input.txt');

print (string) (new PartOne())->run($input) . PHP_EOL;
print (string) (new PartTwo($input))->run() . PHP_EOL;

die(0);
