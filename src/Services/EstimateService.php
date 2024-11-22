<?php

class EstimateService {
    public static function convertEstimate(?int $estimate): string|null
    {
        $conversions = [
            1  => ['hours' => 4,   'days' => 0.5],
            2  => ['hours' => 8,   'days' => 1],
            3  => ['hours' => 12,  'days' => 1.5],
            5  => ['hours' => 24,  'days' => 3],
            8  => ['hours' => 40,  'days' => 5],
            13 => ['hours' => 80,  'days' => 10],
        ];
        if (isset($conversions[$estimate])) {
            $hours = $conversions[$estimate]['hours'];
            $days = $conversions[$estimate]['days'];
            return "$hours hrs / $days days";
        }
        return null;
    }
}
