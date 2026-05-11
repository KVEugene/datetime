<?php

declare(strict_types=1);

namespace KVEugene\DateTime\Tests\Unit;

/**
 * Data provider for TimeOffset tests.
 */
trait TimeOffsetProvider
{
    /**
     * @return array<string, array{string, int}>
     */
    public static function provideYears(): array
    {
        return [
            'One year' => ['1y', 1],
            'One year with TimeZone' => ['1y+0200', 1],
            'One year with TimeZone2' => ['1y-2300', 1],
            'One year with TimeZone3' => ['1y Europe/Riga', 1],
            'Three years' => ['3y', 3],
            '12 months' => ['12m', 0],
            '4 quarters' => ['4q', 0],
            '52 weeks' => ['52w', 0],
            '53 weeks' => ['53w', 0],
            '365 days' => ['365d', 0],
            '366 days' => ['366d', 0],
        ];
    }

    /**
     * @return array<string, array{string, int}>
     */
    public static function provideMonths(): array
    {
        return [
            'One month' => ['1n', 1],
            'One month with TimeZone' => ['1n+0200', 1],
            'One month with TimeZone2' => ['1n-2300', 1],
            'One month with TimeZone3' => ['1n Europe/Riga', 1],
            'Three months' => ['3n', 3],
            '30 days' => ['30d', 0],
            '31 days' => ['31d', 0],
            '1 quarter' => ['1q', 3],
            '3 quarters' => ['3q', 9],
            '1 year' => ['1y', 0],
        ];
    }

    /**
     * @return array<string, array{string, int}>
     */
    public static function provideDays(): array
    {
        return [
            'One day' => ['1d', 1],
            'One day with TimeZone' => ['1d+0200', 1],
            'One day with TimeZone2' => ['1d-2300', 1],
            'One day with TimeZone3' => ['1d Europe/Riga', 1],
            '28 days' => ['28d', 28],
            '30 days' => ['30d', 30],
            '31 days' => ['31d', 31],
            '90 days' => ['90d', 90],
            '1 month' => ['1n', 0],
            '24 hours' => ['24h', 0],
        ];
    }

    /**
     * @return array<string, array{string, int}>
     */
    public static function provideHours(): array
    {
        return [
            'One hour' => ['1h', 1],
            'One hour with TimeZone' => ['1h+0200', 1],
            'One hour with TimeZone2' => ['1h-2300', 1],
            'One hour with TimeZone3' => ['1h Europe/Riga', 1],
            '5 hours' => ['5h', 5],
            '24 hours' => ['24h', 24],
            '168 hours' => ['168h', 168],
            '60 minutes' => ['60m', 0],
            '3600 seconds' => ['3600s', 0],
            '1 day' => ['1d', 0],
            '4 days' => ['4d', 0],
            '1 week' => ['1w', 0],
        ];
    }

    /**
     * @return array<string, int{string, int}>
     */
    public static function provideMinutes(): array
    {
        return [
            'One minute' => ['1m', 1],
            'One minute with TimeZone' => ['1m+0200', 1],
            'One minute with TimeZone2' => ['1m-2300', 1],
            'One minute with TimeZone3' => ['1m Europe/Riga', 1],
            '9 minute' => ['9m', 9],
            '60 minutes' => ['60m', 60],
            '1440 minutes' => ['1440m', 1440],
            '60 seconds' => ['60s', 0],
            '120 seconds' => ['120s', 0],
            '1 hour' => ['1h', 0],
            '1 day' => ['1d', 0],
        ];
    }

    /**
     * @return array<string, array{string, int}>
     */
    public static function provideSeconds(): array
    {
        return [
            'One second' => ['1s', 1],
            'One second with TimeZone' => ['1s+0200', 1],
            'One second with TimeZone2' => ['1s-2300', 1],
            'One second with TimeZone3' => ['1s Europe/Riga', 1],
            '7 second' => ['7s', 7],
            '60 seconds' => ['60s', 60],
            '120 seconds' => ['120s', 120],
            '3600 seconds' => ['3600s', 3600],
            '1 minute' => ['1m', 0],
            '1 hour' => ['1h', 0],
            '1 day' => ['1d', 0],
        ];
    }

    /**
     * @return array<string, array{string, string, string}>
     */
    public static function provideOffsetWithTimeZone(): array
    {
        return [
            'CW one day +0200' => ['1d+0200', '2023-10-05 11:23:58', '2023-10-04 22:00:00'],
            'CW three days +0200' => ['3d+0200', '2023-10-05 14:18:33', '2023-10-02 22:00:00'],
            'CW one week +0200' => ['1w+0200', '2023-10-05 22:00:00', '2023-10-01 22:00:00'],
            'CW three week +0200' => ['3w+0200', '2023-10-05 22:00:00', '2023-09-17 22:00:00'],
            'CW one month +0200' => ['1n+0200', '2023-10-05 22:00:00', '2023-09-30 22:00:00'],
            'CW three month +0200' => ['3n+0200', '2023-10-05 22:00:00', '2023-07-31 22:00:00'],
            'CW one quarter +0200' => ['1q+0200', '2023-10-05 22:00:00', '2023-09-30 22:00:00'],
            'CW three quarter +0200' => ['3q+0200', '2023-10-05 22:00:00', '2023-03-31 22:00:00'],
            'CW one year +0200' => ['1y+0200', '2023-10-05 22:00:00', '2022-12-31 22:00:00'],
            'CW three year +0200' => ['3y+0200', '2023-10-05 22:00:00', '2020-12-31 22:00:00'],

            'CW one day Europe/Riga Summer' => ['1d Europe/Riga', '2023-10-05 11:23:58', '2023-10-04 21:00:00'],
            'CW three days Europe/Riga Summer' => ['3d Europe/Riga', '2023-10-05 14:18:33', '2023-10-02 21:00:00'],
            'CW one week Europe/Riga Summer' => ['1w Europe/Riga', '2023-10-05 22:00:00', '2023-10-01 21:00:00'],
            'CW three week Europe/Riga Summer' => ['3w Europe/Riga', '2023-10-05 22:00:00', '2023-09-17 21:00:00'],
            'CW one month Europe/Riga Summer' => ['1n Europe/Riga', '2023-10-05 22:00:00', '2023-09-30 21:00:00'],
            'CW three month Europe/Riga Summer' => ['3n Europe/Riga', '2023-10-05 22:00:00', '2023-07-31 21:00:00'],
            'CW one quarter Europe/Riga Summer' => ['1q Europe/Riga', '2023-10-05 22:00:00', '2023-09-30 21:00:00'],
            'CW three quarter Europe/Riga Summer' => ['3q Europe/Riga', '2023-10-05 22:00:00', '2023-03-31 21:00:00'],
            'CW one year Europe/Riga Winter' => ['1y Europe/Riga', '2023-10-05 22:00:00', '2022-12-31 22:00:00'],
            'CW three year Europe/Riga Winter' => ['3y Europe/Riga', '2023-10-05 22:00:00', '2020-12-31 22:00:00'],
        ];
    }

    /**
     * @return array<string, array{string, string, string}>
     */
    public static function provideOffset(): array
    {
        return [
            'One second' => ['1s', '2023-10-05 11:23:58', '2023-10-05 11:23:57'],
            'Three seconds' => ['3s', '2023-10-05 14:18:33', '2023-10-05 14:18:30'],
            'One minute' => ['1m', '2023-10-05 11:23:58', '2023-10-05 11:22:58'],
            'Three minutes' => ['3m', '2023-10-05 14:18:33', '2023-10-05 14:15:33'],
            'One hour' => ['1h', '2023-10-05 11:23:58', '2023-10-05 10:23:58'],
            'Three hours' => ['3h', '2023-10-05 14:18:33', '2023-10-05 11:18:33'],
            'One day' => ['1d', '2023-10-05 11:23:58', '2023-10-04 11:23:58'],
            'Three days' => ['3d', '2023-10-05 14:18:33', '2023-10-02 14:18:33'],
            'One week' => ['1w', '2023-10-05 22:00:00', '2023-09-28 22:00:00'],
            'Three weeks' => ['3w', '2023-10-05 22:00:00', '2023-09-14 22:00:00'],
            'One month' => ['1n', '2023-10-05 22:00:00', '2023-09-05 22:00:00'],
            'Three months' => ['3n', '2023-10-05 22:00:00', '2023-07-05 22:00:00'],
            'One quarter' => ['1q', '2023-10-05 22:00:00', '2023-07-05 22:00:00'],
            'Three quarters' => ['3q', '2023-10-05 22:00:00', '2023-01-05 22:00:00'],
            'One year' => ['1y', '2023-10-05 22:00:00', '2022-10-05 22:00:00'],
            'Three years' => ['3y', '2023-10-05 22:00:00', '2020-10-05 22:00:00'],
        ];
    }

    /**
     * @return array<string, array{offset: string, origin: string, expected: string}>
     */
    public static function provideInfinities(): array
    {
        return [
            'None seconds' => [
                'offset' => '0s',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None seconds with timezone' => [
                'offset' => '0s+0200',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None minutes' => [
                'offset' => '0m',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None minutes with timezone' => [
                'offset' => '0m+0200',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None hours' => [
                'offset' => '0h',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58'
            ],
            'None hours with timezone' => [
                'offset' => '0h+0200',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None days' => [
                'offset' => '0d',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58'
            ],
            'None days with timezone' => [
                'offset' => '0d+0200',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None weeks' => [
                'offset' => '0w',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58'
            ],
            'None weeks with timezone' => [
                'offset' => '0w+0200',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None months' => [
                'offset' => '0n',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58'
            ],
            'None months with timezone' => [
                'offset' => '0n+0200',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None quarters' => [
                'offset' => '0q',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None quarters with timezone' => [
                'offset' => '0q+0200',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'None years' => [
                'offset' => '0y',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58'
            ],
            'None years with timezone' => [
                'offset' => '0y+0200',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58',
            ],
            'Blank string' => [
                'offset' => '',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58'
            ],
            'Key "all"' => [
                'offset' => 'all',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58'
            ],
            'Any text' => [
                'offset' => 'test',
                'origin' => '2023-10-05 11:23:58',
                'expected' => '2023-10-05 11:23:58'
            ],
        ];
    }

    /**
     * @return array<string, array{offset: string, expected: string}>
     */
    public static function provideCastToString(): array
    {
        return [
            'Infinity' => ['offset' => 'all', 'expected' => 'Infinity'],
            '3w' => ['offset' => '1814400s', 'expected' => 'P3W'],
            '20h' => ['offset' => '1200m', 'expected' => 'PT20H'],
            '377s' => ['offset' => '377s', 'expected' => 'PT6M17S'],
            '3d' => ['offset' => '72h', 'expected' => 'P3D'],
            '10m' => ['offset' => '600s', 'expected' => 'PT10M'],
            '601s' => ['offset' => '601s', 'expected' => 'PT10M1S'],
        ];
    }
}
