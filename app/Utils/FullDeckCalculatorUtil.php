<?php

namespace App\Utils;

class FullDeckCalculatorUtil
{
    private static array $cardItems = [
        'A' => 0,
        '2' => 0,
        '3' => 0,
        '4' => 0,
        '5' => 0,
        '6' => 0,
        '7' => 0,
        '8' => 0,
        '9' => 0,
        '10' => 0,
        'J' => 0,
        'Q' => 0,
        'K' => 0
    ];

    public static function getFullDecks(array $mixedCards): int
    {
        $result = [
            'hearts' => self::$cardItems,
            'clubs' => self::$cardItems,
            'diamonds' => self::$cardItems,
            'spades' => self::$cardItems,
        ];

        foreach ($mixedCards as $card) {
            $cardSuit = $card['suit'];

            $cardValue = $card['value'];
            $result[$cardSuit][$cardValue]++;
        }

        return collect($result)
            ->map(function ($suit) {
                return collect($suit)->min();
            })
            ->values()
            ->min();
    }
}
