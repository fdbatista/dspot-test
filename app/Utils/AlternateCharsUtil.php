<?php

namespace App\Utils;

class AlternateCharsUtil
{
    public static function alternatingCharacters(string $string): int
    {
        $adjacentCharsCount = 0;
        $charArray = str_split($string);
        $charCount = count($charArray);

        for ($i = 0; $i < $charCount; $i++) {
            $nextIndex = $i + 1;

            if ($nextIndex < $charCount && $charArray[$nextIndex] === $charArray[$i]) {
                $adjacentCharsCount ++;
            }
        }

        return $adjacentCharsCount;
    }
}
