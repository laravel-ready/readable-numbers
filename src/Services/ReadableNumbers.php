<?php

namespace LaravelReady\ReadableNumbers\Services;

class ReadableNumbers
{
    public function __construct()
    {
    }

    /** @var array ['suffix' => 'threshold'] */
    private static $thresholds = [
        '' => 900,
        'k' => 900000,
        'm' => 900000000,
        'b' => 900000000000,
        't' => 90000000000000,
    ];

    /**
     * Find readable number in thresholds range
     *
     * @param float $value
     * @param int $decimals
     * @return string
     */
    public static function make(float $value, int $decimals = 1, $lang = null): string
    {
        if ($value == 0) {
            return '0';
        }

        $value = abs($value);
        $isNegative = $value < 0;
        $lang = $lang ? strtolower($lang) : app()->getLocale();

        foreach (self::$thresholds as $suffix => $threshold) {
            if ($value <= $threshold) {
                $suffix = trans("readable-trans::suffix.{$suffix}", [], $lang);

                return ($isNegative ? '-' : '') . self::format($value, $decimals, $threshold, $suffix);
            }
        }

        return '0';
    }

    /**
     * Format and translate number
     *
     * @param float $value
     * @param int $decimals
     * @param int $threshold
     * @param string $suffix
     * @return string
     */
    public static function format(float $value, int $decimals, int $threshold, string $suffix): string
    {
        $value = $value / ($threshold / self::$thresholds['']);

        $formattedNumber = number_format($value, $decimals);

        $cleanedNumber = (strpos($formattedNumber, '.') === false)
            ? $formattedNumber
            : rtrim(rtrim($formattedNumber, '0'), '.');

        return "{$cleanedNumber} {$suffix}";
    }
}
