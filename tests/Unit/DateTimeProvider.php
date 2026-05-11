<?php

declare(strict_types=1);

namespace KVEugene\DateTime\Tests\Unit;

use DateInterval;
use KVEugene\DateTime\TimeOffset;

/**
 * Data provider for testing date and time representation.
 */
trait DateTimeProvider
{
    /**
     * @return array<string, array{year: int}>
     */
    public static function yearsProvider(): array
    {
        return [
            'Year 0'     => ['year' => 0],
            'Year 1'     => ['year' => 1],
            'Year 827'   => ['year' => 827],
            'Year 1812'  => ['year' => 1812],
            'Year 2000'  => ['year' => 2000],
            'Year 2025'  => ['year' => 2025],
            'Year 2100'  => ['year' => 2100],
            'Year 3000'  => ['year' => 3000],
            'Year 12345' => ['year' => 12345],
        ];
    }

    /**
     * @return iterable
     */
    public static function monthsProvider(): iterable
    {
        for ($i = 0; $i <= 20; ++$i) {
            yield 'Month ' . $i => ['month' => $i];
        }
    }

    /**
     * @return iterable
     */
    public static function daysProvider(): iterable
    {
        for ($i = 0; $i <= 60; ++$i) {
            yield 'Day ' . $i => ['day' => $i];
        }
    }

    /**
     * @return iterable
     */
    public static function hoursProvider(): iterable
    {
        for ($i = 0; $i <= 50; ++$i) {
            yield 'Hour ' . $i => ['hour' => $i];
        }
    }

    /**
     * @return iterable
     */
    public static function minutesProvider(): iterable
    {
        for ($i = 0; $i <= 600; $i += 7) {
            yield 'Minutes ' . $i => ['minute' => $i];
        }
    }

    /**
     * @return iterable
     */
    public static function secondsProvider(): iterable
    {
        for ($i = 0; $i <= 600; $i += 9) {
            yield 'Seconds ' . $i => ['second' => $i];
        }
    }

    /**
     * @return iterable
     */
    public static function microsecondsProvider(): iterable
    {
        for ($i = 0; $i <= 6000000; $i += 98765) {
            yield 'Microsecond ' . $i => ['microsecond' => $i];
        }
    }

    /**
     * @return array<string, array{date: string, expected: int}>
     */
    public static function dayLastProvider(): iterable
    {
        return [
            'January 2000'   => ['date' => '2000-01-07', 'expected' => 31],
            'February 2001'  => ['date' => '2001-02-14', 'expected' => 28],
            'March 2002'     => ['date' => '2002-03-08', 'expected' => 31],
            'April 2003'     => ['date' => '2003-04-22', 'expected' => 30],
            'May 2004'       => ['date' => '2004-05-09', 'expected' => 31],
            'June 2005'      => ['date' => '2005-06-12', 'expected' => 30],
            'July 2006'      => ['date' => '2006-07-04', 'expected' => 31],
            'August 2007'    => ['date' => '2007-08-20', 'expected' => 31],
            'September 2008' => ['date' => '2008-09-01', 'expected' => 30],
            'October 2009'   => ['date' => '2009-10-07', 'expected' => 31],
            'November 2010'  => ['date' => '2010-11-07', 'expected' => 30],
            'December 2011'  => ['date' => '2011-12-31', 'expected' => 31],
            'February 2012'  => ['date' => '2012-02-23', 'expected' => 29],
        ];
    }

    /**
     * @return array<string, array{date: string, expected: int}>
     */
    public static function quarterProvider(): iterable
    {
        return [
            'January 2000'   => ['date' => '2000-01-07', 'expected' => 1],
            'February 2001'  => ['date' => '2001-02-14', 'expected' => 1],
            'March 2002'     => ['date' => '2002-03-08', 'expected' => 1],
            'April 2003'     => ['date' => '2003-04-22', 'expected' => 2],
            'May 2004'       => ['date' => '2004-05-09', 'expected' => 2],
            'June 2005'      => ['date' => '2005-06-12', 'expected' => 2],
            'July 2006'      => ['date' => '2006-07-04', 'expected' => 3],
            'August 2007'    => ['date' => '2007-08-20', 'expected' => 3],
            'September 2008' => ['date' => '2008-09-01', 'expected' => 3],
            'October 2009'   => ['date' => '2009-10-07', 'expected' => 4],
            'November 2010'  => ['date' => '2010-11-07', 'expected' => 4],
            'December 2011'  => ['date' => '2011-12-31', 'expected' => 4],
            'February 2012'  => ['date' => '2012-02-23', 'expected' => 1],
        ];
    }

    /**
     * @return array<string, array{date: string, expected: int}>
     */
    public static function halfYearProvider(): iterable
    {
        return [
            'January 2000'   => ['date' => '2000-01-07', 'expected' => 1],
            'February 2001'  => ['date' => '2001-02-14', 'expected' => 1],
            'March 2002'     => ['date' => '2002-03-08', 'expected' => 1],
            'April 2003'     => ['date' => '2003-04-22', 'expected' => 1],
            'May 2004'       => ['date' => '2004-05-09', 'expected' => 1],
            'June 2005'      => ['date' => '2005-06-12', 'expected' => 1],
            'July 2006'      => ['date' => '2006-07-04', 'expected' => 2],
            'August 2007'    => ['date' => '2007-08-20', 'expected' => 2],
            'September 2008' => ['date' => '2008-09-01', 'expected' => 2],
            'October 2009'   => ['date' => '2009-10-07', 'expected' => 2],
            'November 2010'  => ['date' => '2010-11-07', 'expected' => 2],
            'December 2011'  => ['date' => '2011-12-31', 'expected' => 2],
            'February 2012'  => ['date' => '2012-02-23', 'expected' => 1],
        ];
    }

    /**
     * @return array<string, array{date: string, expected: int}>
     */
    public static function weekdayProvider(): iterable
    {
        return [
            'January 2000'   => ['date' => '2000-01-07', 'expected' => 5],
            'February 2001'  => ['date' => '2001-02-14', 'expected' => 3],
            'March 2002'     => ['date' => '2002-03-08', 'expected' => 5],
            'April 2003'     => ['date' => '2003-04-22', 'expected' => 2],
            'May 2004'       => ['date' => '2004-05-09', 'expected' => 0],
            'June 2005'      => ['date' => '2005-06-12', 'expected' => 0],
            'July 2006'      => ['date' => '2006-07-04', 'expected' => 2],
            'August 2007'    => ['date' => '2007-08-20', 'expected' => 1],
            'September 2008' => ['date' => '2008-09-01', 'expected' => 1],
            'October 2009'   => ['date' => '2009-10-07', 'expected' => 3],
            'November 2010'  => ['date' => '2010-11-07', 'expected' => 0],
            'December 2011'  => ['date' => '2011-12-31', 'expected' => 6],
            'February 2012'  => ['date' => '2012-02-23', 'expected' => 4],
        ];
    }

    /**
     * @return array<string, array{date1: string, date2: string, expected: string}
     */
    public static function diffDatesProvider(): iterable
    {
        return [
            ['date1' => '2000-01-01', 'date2' => '2001-01-01', 'expected' => 'P1Y'],
            ['date1' => '2000-01-01', 'date2' => '2000-02-01', 'expected' => 'P1M'],
            ['date1' => '2000-01-01', 'date2' => '2000-01-02', 'expected' => 'P1D'],
            ['date1' => '2000-01-01', 'date2' => '2001-02-01', 'expected' => 'P1Y1M'],
            ['date1' => '2000-01-01', 'date2' => '2001-01-02', 'expected' => 'P1Y1D'],
            ['date1' => '2000-01-01', 'date2' => '2000-02-02', 'expected' => 'P1M1D'],
            ['date1' => '2000-01-01', 'date2' => '2001-02-02', 'expected' => 'P1Y1M1D'],

            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-01 01:00:00', 'expected' => 'PT1H'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-01 00:01:00', 'expected' => 'PT1M'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-01 00:00:01', 'expected' => 'PT1S'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-01 01:01:00', 'expected' => 'PT1H1M'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-01 01:00:01', 'expected' => 'PT1H1S'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-01 00:01:01', 'expected' => 'PT1M1S'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-01 01:01:01', 'expected' => 'PT1H1M1S'],

            ['date1' => '2000-01-01 00:00:00', 'date2' => '2001-01-01 01:00:00', 'expected' => 'P1YT1H'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2001-01-01 00:01:00', 'expected' => 'P1YT1M'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2001-01-01 00:00:01', 'expected' => 'P1YT1S'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-02-01 01:00:00', 'expected' => 'P1MT1H'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-02-01 00:01:00', 'expected' => 'P1MT1M'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-02-01 00:00:01', 'expected' => 'P1MT1S'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-02 01:00:00', 'expected' => 'P1DT1H'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-02 00:01:00', 'expected' => 'P1DT1M'],
            ['date1' => '2000-01-01 00:00:00', 'date2' => '2000-01-02 00:00:01', 'expected' => 'P1DT1S'],

            ['date1' => '2000-01-01 00:00:00+0000', 'date2' => '2000-01-01 00:00:00+0315', 'expected' => 'PT3H15M'],
            ['date1' => '2000-01-01 00:00:00-0000', 'date2' => '2000-01-01 00:00:00+0315', 'expected' => 'PT3H15M'],
            ['date1' => '2000-01-01 00:00:00+0315', 'date2' => '2000-01-01 00:00:00+0000', 'expected' => 'PT3H15M'],
            ['date1' => '2000-01-01 00:00:00+0315', 'date2' => '2000-01-01 00:00:00-0000', 'expected' => 'PT3H15M'],
            ['date1' => '2000-01-01 00:00:00+0315', 'date2' => '2000-01-01 00:00:00+0200', 'expected' => 'PT1H15M'],
            ['date1' => '2000-01-01 00:00:00+0000', 'date2' => '2000-01-01 00:00:00-0220', 'expected' => 'PT2H20M'],
            ['date1' => '2000-01-01 00:00:00-0220', 'date2' => '2000-01-01 00:00:00+0000', 'expected' => 'PT2H20M'],
            ['date1' => '2000-01-01 00:00:00-0000', 'date2' => '2000-01-01 00:00:00-0220', 'expected' => 'PT2H20M'],
            ['date1' => '2000-01-01 00:00:00-0220', 'date2' => '2000-01-01 00:00:00-0000', 'expected' => 'PT2H20M'],
        ];
    }

    /**
     * @return array<string, array{date: string, interval: DateInterval, expected: string}>
     */
    public static function addIntervalProvider(): iterable
    {
        return [
            'Date interval 1Y'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1Y'),
                'expected' => '2021-05-07 14:06:11',
            ],
            'Date interval 1M'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1M'),
                'expected' => '2020-06-07 14:06:11',
            ],
            'Date interval 1D'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1D'),
                'expected' => '2020-05-08 14:06:11',
            ],
            'Date interval 1Y 1M'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1Y1M'),
                'expected' => '2021-06-07 14:06:11',
            ],
            'Date interval 1Y 1D'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1Y1D'),
                'expected' => '2021-05-08 14:06:11',
            ],
            'Date interval 1M 1D'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1M1D'),
                'expected' => '2020-06-08 14:06:11',
            ],
            'Date interval 1Y 1M 1D' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1Y1M1D'),
                'expected' => '2021-06-08 14:06:11',
            ],

            'Date interval time 1H'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1H'),
                'expected' => '2020-05-07 15:06:11',
            ],
            'Date interval time 1M'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1M'),
                'expected' => '2020-05-07 14:07:11',
            ],
            'Date interval time 1S'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1S'),
                'expected' => '2020-05-07 14:06:12',
            ],
            'Date interval time 1H 1M'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1H1M'),
                'expected' => '2020-05-07 15:07:11',
            ],
            'Date interval time 1H 1S'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1H1S'),
                'expected' => '2020-05-07 15:06:12',
            ],
            'Date interval time 1M 1S'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1M1S'),
                'expected' => '2020-05-07 14:07:12',
            ],
            'Date interval time 1H 1M 1S' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1H1M1S'),
                'expected' => '2020-05-07 15:07:12',
            ],

            'Time offset 1y' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1y'),
                'expected' => '2021-05-07 14:06:11',
            ],
            'Time offset 1q' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1q'),
                'expected' => '2020-08-07 14:06:11',
            ],
            'Time offset 1n' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1n'),
                'expected' => '2020-06-07 14:06:11',
            ],
            'Time offset 1w' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1w'),
                'expected' => '2020-05-14 14:06:11',
            ],
            'Time offset 1d' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1d'),
                'expected' => '2020-05-08 14:06:11',
            ],
            'Time offset 1h' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1h'),
                'expected' => '2020-05-07 15:06:11',
            ],
            'Time offset 1m' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1m'),
                'expected' => '2020-05-07 14:07:11',
            ],
            'Time offset 1s' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1s'),
                'expected' => '2020-05-07 14:06:12',
            ],

            'Time offset 1y+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1y+0200'),
                'expected' => '2020-12-31 22:00:00',
            ],
            'Time offset 1q+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1q+0200'),
                'expected' => '2020-06-30 22:00:00',
            ],
            'Time offset 1n+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1n+0200'),
                'expected' => '2020-05-31 22:00:00',
            ],
            'Time offset 1w+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1w+0200'),
                'expected' => '2020-05-10 22:00:00',
            ],
            'Time offset 1d+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1d+0200'),
                'expected' => '2020-05-07 22:00:00',
            ],
            'Time offset 1h+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1h+0200'),
                'expected' => '2020-05-07 15:00:00',
            ],
            'Time offset 1m+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1m+0200'),
                'expected' => '2020-05-07 14:07:00',
            ],
            'Time offset 1s+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1s+0200'),
                'expected' => '2020-05-07 14:06:12',
            ],

            'Time offset 3y+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3y+0200'),
                'expected' => '2022-12-31 22:00:00',
            ],
            'Time offset 3q+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3q+0200'),
                'expected' => '2020-12-31 22:00:00',
            ],
            'Time offset 3n+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3n+0200'),
                'expected' => '2020-07-31 22:00:00',
            ],
            'Time offset 3w+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3w+0200'),
                'expected' => '2020-05-24 22:00:00',
            ],
            'Time offset 3d+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3d+0200'),
                'expected' => '2020-05-09 22:00:00',
            ],
            'Time offset 3h+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3h+0200'),
                'expected' => '2020-05-07 17:00:00',
            ],
            'Time offset 3m+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3m+0200'),
                'expected' => '2020-05-07 14:09:00',
            ],
            'Time offset 3s+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3s+0200'),
                'expected' => '2020-05-07 14:06:14',
            ],

            'Time offset 1y+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1y+0000'),
                'expected' => '2021-01-01 00:00:00',
            ],
            'Time offset 1q+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1q+0000'),
                'expected' => '2020-07-01 00:00:00',
            ],
            'Time offset 1n+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1n+0000'),
                'expected' => '2020-06-01 00:00:00',
            ],
            'Time offset 1w+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1w+0000'),
                'expected' => '2020-05-11 00:00:00',
            ],
            'Time offset 1d+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1d+0000'),
                'expected' => '2020-05-08 00:00:00',
            ],
            'Time offset 1h+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1h+0000'),
                'expected' => '2020-05-07 15:00:00',
            ],
            'Time offset 1m+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1m+0000'),
                'expected' => '2020-05-07 14:07:00',
            ],
            'Time offset 1s+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1s+0000'),
                'expected' => '2020-05-07 14:06:12',
            ],
        ];
    }

    /**
     * @return array<string, array{date: string, interval: DateInterval, expected: string}>
     */
    public static function subIntervalProvider(): iterable
    {
        return [
            'Date interval 1Y'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1Y'),
                'expected' => '2019-05-07 14:06:11',
            ],
            'Date interval 1M'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1M'),
                'expected' => '2020-04-07 14:06:11',
            ],
            'Date interval 1D'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1D'),
                'expected' => '2020-05-06 14:06:11',
            ],
            'Date interval 1Y 1M'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1Y1M'),
                'expected' => '2019-04-07 14:06:11',
            ],
            'Date interval 1Y 1D'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1Y1D'),
                'expected' => '2019-05-06 14:06:11',
            ],
            'Date interval 1M 1D'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1M1D'),
                'expected' => '2020-04-06 14:06:11',
            ],
            'Date interval 1Y 1M 1D' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('P1Y1M1D'),
                'expected' => '2019-04-06 14:06:11',
            ],

            'Date interval time 1H'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1H'),
                'expected' => '2020-05-07 13:06:11',
            ],
            'Date interval time 1M'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1M'),
                'expected' => '2020-05-07 14:05:11',
            ],
            'Date interval time 1S'       => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1S'),
                'expected' => '2020-05-07 14:06:10',
            ],
            'Date interval time 1H 1M'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1H1M'),
                'expected' => '2020-05-07 13:05:11',
            ],
            'Date interval time 1H 1S'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1H1S'),
                'expected' => '2020-05-07 13:06:10',
            ],
            'Date interval time 1M 1S'    => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1M1S'),
                'expected' => '2020-05-07 14:05:10',
            ],
            'Date interval time 1H 1M 1S' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new DateInterval('PT1H1M1S'),
                'expected' => '2020-05-07 13:05:10',
            ],

            'Time offset 1y' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1y'),
                'expected' => '2019-05-07 14:06:11',
            ],
            'Time offset 1q' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1q'),
                'expected' => '2020-02-07 14:06:11',
            ],
            'Time offset 1n' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1n'),
                'expected' => '2020-04-07 14:06:11',
            ],
            'Time offset 1w' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1w'),
                'expected' => '2020-04-30 14:06:11',
            ],
            'Time offset 1d' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1d'),
                'expected' => '2020-05-06 14:06:11',
            ],
            'Time offset 1h' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1h'),
                'expected' => '2020-05-07 13:06:11',
            ],
            'Time offset 1m' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1m'),
                'expected' => '2020-05-07 14:05:11',
            ],
            'Time offset 1s' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1s'),
                'expected' => '2020-05-07 14:06:10',
            ],

            'Time offset 1y+0200'                => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1y+0200'),
                'expected' => '2019-12-31 22:00:00',
            ],
            'Time offset 1q+0200'                => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1q+0200'),
                'expected' => '2020-03-31 22:00:00',
            ],
            'Time offset 1n+0200'                => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1n+0200'),
                'expected' => '2020-04-30 22:00:00',
            ],
            'Time offset 1w+0200'                => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1w+0200'),
                'expected' => '2020-05-03 22:00:00',
            ],
            'Time offset 1d+0200'                => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1d+0200'),
                'expected' => '2020-05-06 22:00:00',
            ],
            'Time offset 1h+0200'                => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1h+0200'),
                'expected' => '2020-05-07 14:00:00',
            ],
            'Time offset 1m+0200'                => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1m+0200'),
                'expected' => '2020-05-07 14:06:00',
            ],
            'Time offset 1s+0200'                => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1s+0200'),
                'expected' => '2020-05-07 14:06:11',
            ],

            'Time offset 3y+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3y+0200'),
                'expected' => '2017-12-31 22:00:00',
            ],
            'Time offset 3q+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3q+0200'),
                'expected' => '2019-09-30 22:00:00',
            ],
            'Time offset 3n+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3n+0200'),
                'expected' => '2020-02-29 22:00:00',
            ],
            'Time offset 3w+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3w+0200'),
                'expected' => '2020-04-19 22:00:00',
            ],
            'Time offset 3d+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3d+0200'),
                'expected' => '2020-05-04 22:00:00',
            ],
            'Time offset 3h+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3h+0200'),
                'expected' => '2020-05-07 12:00:00',
            ],
            'Time offset 3m+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3m+0200'),
                'expected' => '2020-05-07 14:04:00',
            ],
            'Time offset 3s+0200' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('3s+0200'),
                'expected' => '2020-05-07 14:06:09',
            ],

            'Time offset 1y+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1y+0000'),
                'expected' => '2020-01-01 00:00:00',
            ],
            'Time offset 1q+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1q+0000'),
                'expected' => '2020-04-01 00:00:00',
            ],
            'Time offset 1n+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1n+0000'),
                'expected' => '2020-05-01 00:00:00',
            ],
            'Time offset 1w+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1w+0000'),
                'expected' => '2020-05-04 00:00:00',
            ],
            'Time offset 1d+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1d+0000'),
                'expected' => '2020-05-07 00:00:00',
            ],
            'Time offset 1h+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1h+0000'),
                'expected' => '2020-05-07 14:00:00',
            ],
            'Time offset 1m+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1m+0000'),
                'expected' => '2020-05-07 14:06:00',
            ],
            'Time offset 1s+0000' => [
                'date'     => '2020-05-07 14:06:11',
                'interval' => new TimeOffset('1s+0000'),
                'expected' => '2020-05-07 14:06:11',
            ],
        ];
    }

    /**
     * @return array<string, array{date: string, interval: DateInterval, expected: string}>
     */
    public static function addIntervalMicrotimeProvider(): iterable
    {
        return [
            'Time offset 1s' => [
                'date'     => '2020-05-07 14:06:11.123456',
                'interval' => new TimeOffset('1s'),
                'expected' => '2020-05-07 14:06:12.123456',
            ],
            'Time offset 1s+0200 with microtime' => [
                'date'     => '2020-05-07 14:06:11.123456',
                'interval' => new TimeOffset('1s+0200'),
                'expected' => '2020-05-07 14:06:12.000000',
            ],
            'Time offset 3s+0200 with microtime' => [
                'date'     => '2020-05-07 14:06:11.123456',
                'interval' => new TimeOffset('3s+0200'),
                'expected' => '2020-05-07 14:06:14.000000',
            ],
            'Time offset 1s+0000 with microtime' => [
                'date'     => '2020-05-07 14:06:11.123456',
                'interval' => new TimeOffset('1s+0000'),
                'expected' => '2020-05-07 14:06:12.000000',
            ],
        ];
    }

    /**
     * @return array<string, array{date: string, interval: DateInterval, expected: string}>
     */
    public static function subIntervalMicrotimeProvider(): iterable
    {
        return [
            'Time offset 1s' => [
                'date'     => '2020-05-07 14:06:11.123456',
                'interval' => new TimeOffset('1s'),
                'expected' => '2020-05-07 14:06:10.123456',
            ],
            'Time offset 1s+0200 with microtime' => [
                'date'     => '2020-05-07 14:06:11.123456',
                'interval' => new TimeOffset('1s+0200'),
                'expected' => '2020-05-07 14:06:11.000000',
            ],
            'Time offset 3s+0200 with microtime' => [
                'date'     => '2020-05-07 14:06:11.123456',
                'interval' => new TimeOffset('3s+0200'),
                'expected' => '2020-05-07 14:06:09.000000',
            ],
            'Time offset 1s+0000 with microtime' => [
                'date'     => '2020-05-07 14:06:11.123456',
                'interval' => new TimeOffset('1s+0000'),
                'expected' => '2020-05-07 14:06:11.000000',
            ],
        ];
    }
}
