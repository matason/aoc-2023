<?php
declare(strict_types=1);

namespace Matason\Aoc2023\Common {
    function getInputAsArray(string $path): array
    {
        if (false === file_exists(getcwd() . $path)) {
            return [];
        }

        if (false === ($contents = file_get_contents(getcwd() . $path))) {
            return [];
        }

        return array_filter(explode("\n", $contents));
    }
}
