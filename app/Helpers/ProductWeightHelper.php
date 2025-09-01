<?php

namespace App\Helpers;

class ProductWeightHelper
{
    /**
     * Estimate weight in grams/ml from a unit string.
     */
    public static function parse(string $unit): int
    {
        $unit = strtolower(trim($unit));

        // Normalize common formatting/spelling
        $unit = str_replace(['×', 'x', 'ltr', 'liters', 'litres', 'lt', 'ltires', 'liter'], 'x', $unit);
        $unit = preg_replace('/[^a-z0-9. x]/', '', $unit); // Keep relevant characters

        // Match patterns like: 1.5kg, 100g, 2kg x 4, 330ml x 12, etc.
        if (preg_match_all('/([\d.]+)\s*(kg|g|ml|l|cl)\s*(x\s*([\d]+))?/', $unit, $matches, PREG_SET_ORDER)) {
            $totalWeight = 0;

            foreach ($matches as $match) {
                $value = (float) $match[1];
                $unitType = $match[2];
                $multiplier = isset($match[4]) ? (int) $match[4] : 1;

                switch ($unitType) {
                    case 'kg':
                        $weight = $value * 1000;
                        break;
                    case 'g':
                        $weight = $value;
                        break;
                    case 'l':
                        $weight = $value * 1000;
                        break;
                    case 'ml':
                        $weight = $value;
                        break;
                    case 'cl':
                        $weight = $value * 10;
                        break;
                    default:
                        $weight = 0;
                }

                $totalWeight += $weight * $multiplier;
            }

            // Ensure it's at least 1 gram to avoid Sendcloud failure
            return max((int) $totalWeight, 1);
        }

        // Fallback logic for descriptive units
        if (str_contains($unit, 'pack') || str_contains($unit, 'box')) {
            return 9000; // heavy default
        }

        if (str_contains($unit, 'piece') || str_contains($unit, 'pcs')) {
            return 300;
        }

        return 1500; // general default for unknown
    }
    
}
