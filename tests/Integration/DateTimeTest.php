<?php

declare(strict_types=1);

namespace KVEugene\DateTime\Tests\Integration;

use PHPUnit\Framework\TestCase;
use KVEugene\DateTime\DateTime;

/**
 *
 */
class DateTimeTest extends TestCase
{
    /**
     * @return void
     */
    public function testMicroseconds(): void
    {
        $date = new DateTime('first day of January 2025');

        self::assertEquals('2025-01-01 00:00:00.000000', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond += 8;

        self::assertEquals('2025-01-01 00:00:00.000008', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond += -8;

        self::assertEquals('2025-01-01 00:00:00.000000', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond = 500;

        self::assertEquals('2025-01-01 00:00:00.000500', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond = -8;

        self::assertEquals('2024-12-31 23:59:59.999992', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond -= -8;

        self::assertEquals('2025-01-01 00:00:00.000000', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond = 100000000;

        self::assertEquals('2025-01-01 00:01:40.000000', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond -= 40000001;

        self::assertEquals('2025-01-01 00:00:59.999999', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond++;

        self::assertEquals('2025-01-01 00:01:00.000000', $date->format('Y-m-d H:i:s.u'));
        self::assertEquals(0, $date->microsecond);

        $date->microsecond--;
        self::assertEquals('2025-01-01 00:00:59.999999', $date->format('Y-m-d H:i:s.u'));

        $date->setDate(2025, 12,31);
        $date->setTime(23, 59, 59, 999999);

        self::assertEquals('2025-12-31 23:59:59.999999', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond++;
        self::assertEquals('2026-01-01 00:00:00.000000', $date->format('Y-m-d H:i:s.u'));

        $date->microsecond--;
        self::assertEquals('2025-12-31 23:59:59.999999', $date->format('Y-m-d H:i:s.u'));
    }

    /**
     * @return void
     */
    public function testSeconds(): void
    {
        $date = new DateTime('first day of January 2025');

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->second += 8;

        self::assertEquals('2025-01-01 00:00:08', $date->format('Y-m-d H:i:s'));

        $date->second += -8;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->second = 50;

        self::assertEquals('2025-01-01 00:00:50', $date->format('Y-m-d H:i:s'));

        $date->second = -8;

        self::assertEquals('2024-12-31 23:59:52', $date->format('Y-m-d H:i:s'));

        $date->second -= -8;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->second = 100;

        self::assertEquals('2025-01-01 00:01:40', $date->format('Y-m-d H:i:s'));

        $date->second -= 41;

        self::assertEquals('2025-01-01 00:00:59', $date->format('Y-m-d H:i:s'));

        $date->second++;

        self::assertEquals('2025-01-01 00:01:00', $date->format('Y-m-d H:i:s'));
        self::assertEquals(0, $date->second);

        $date->second--;
        self::assertEquals('2025-01-01 00:00:59', $date->format('Y-m-d H:i:s'));

        $date->minute = 59;
        self::assertEquals('2025-01-01 00:59:59', $date->format('Y-m-d H:i:s'));

        $date->second++;
        self::assertEquals('2025-01-01 01:00:00', $date->format('Y-m-d H:i:s'));

        $date->setDate(2025, 12,31);
        $date->setTime(23, 59, 59);

        self::assertEquals('2025-12-31 23:59:59', $date->format('Y-m-d H:i:s'));

        $date->second++;
        self::assertEquals('2026-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->second--;
        self::assertEquals('2025-12-31 23:59:59', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @return void
     */
    public function testMinutes(): void
    {
        $date = new DateTime('first day of January 2025');

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->minute += 7;

        self::assertEquals('2025-01-01 00:07:00', $date->format('Y-m-d H:i:s'));

        $date->minute += -7;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->minute = 50;

        self::assertEquals('2025-01-01 00:50:00', $date->format('Y-m-d H:i:s'));

        $date->minute = -8;

        self::assertEquals('2024-12-31 23:52:00', $date->format('Y-m-d H:i:s'));

        $date->minute -= -8;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->minute = 100;

        self::assertEquals('2025-01-01 01:40:00', $date->format('Y-m-d H:i:s'));

        $date->minute -= 41;

        self::assertEquals('2025-01-01 00:59:00', $date->format('Y-m-d H:i:s'));

        $date->minute++;

        self::assertEquals('2025-01-01 01:00:00', $date->format('Y-m-d H:i:s'));
        self::assertEquals(0, $date->minute);

        $date->minute--;
        self::assertEquals('2025-01-01 00:59:00', $date->format('Y-m-d H:i:s'));

        $date->hour = 23;
        self::assertEquals('2025-01-01 23:59:00', $date->format('Y-m-d H:i:s'));

        $date->minute++;
        self::assertEquals('2025-01-02 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->setDate(2025, 12,31);
        $date->setTime(23, 59);

        self::assertEquals('2025-12-31 23:59:00', $date->format('Y-m-d H:i:s'));

        $date->minute++;
        self::assertEquals('2026-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->minute--;
        self::assertEquals('2025-12-31 23:59:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @return void
     */
    public function testHours(): void
    {
        $date = new DateTime('first day of January 2025');

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour += 7;

        self::assertEquals('2025-01-01 07:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour += -7;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour = 20;

        self::assertEquals('2025-01-01 20:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour = -8;

        self::assertEquals('2024-12-31 16:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour -= -8;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour = 50;

        self::assertEquals('2025-01-03 02:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour -= 27;

        self::assertEquals('2025-01-01 23:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour++;

        self::assertEquals('2025-01-02 00:00:00', $date->format('Y-m-d H:i:s'));
        self::assertEquals(0, $date->hour);

        $date->hour--;
        self::assertEquals('2025-01-01 23:00:00', $date->format('Y-m-d H:i:s'));

        $date->day = 31;
        self::assertEquals('2025-01-31 23:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour++;
        self::assertEquals('2025-02-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->setDate(2025, 12,31);
        $date->setTime(23, 0);

        self::assertEquals('2025-12-31 23:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour++;
        self::assertEquals('2026-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->hour--;
        self::assertEquals('2025-12-31 23:00:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @return void
     */
    public function testDays(): void
    {
        $date = new DateTime('first day of January 2025');

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day += 7;

        self::assertEquals('2025-01-08 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day += -7;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day = 20;

        self::assertEquals('2025-01-20 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day = 0;
        self::assertEquals('2024-12-31 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day++;
        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day = -1;

        self::assertEquals('2024-12-30 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day -= -1;

        self::assertEquals('2024-12-31 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day = 50;

        self::assertEquals('2025-01-19 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day -= 19;

        self::assertEquals('2024-12-31 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->day++;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));
        self::assertEquals(1, $date->day);
    }

    /**
     * @return void
     */
    public function testMonth(): void
    {
        $date = new DateTime('first day of January 2025');

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->month += 7;

        self::assertEquals('2025-08-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->month += -7;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->month = 10;

        self::assertEquals('2025-10-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->month = -8;

        self::assertEquals('2024-04-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->month -= -9;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->month = 15;

        self::assertEquals('2026-03-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->month -= 3;

        self::assertEquals('2025-12-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->month++;

        self::assertEquals('2026-01-01 00:00:00', $date->format('Y-m-d H:i:s'));
        self::assertEquals(1, $date->month);

        $date->month--;
        self::assertEquals('2025-12-01 00:00:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @return void
     */
    public function testYear(): void
    {
        $date = new DateTime('first day of January 2025');

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->year += 7;

        self::assertEquals('2032-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->year += -7;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->year = 2000;

        self::assertEquals('2000-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->year = -8;

        self::assertEquals('-0008-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->year -= -8;

        self::assertEquals('0000-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->year = 2025;

        self::assertEquals('2025-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->year -= 3;

        self::assertEquals('2022-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->year++;

        self::assertEquals('2023-01-01 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->year--;
        self::assertEquals('2022-01-01 00:00:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @return void
     */
    public function testLastDayOfMonth(): void
    {
        $date = new DateTime('last day of March 2025');

        self::assertEquals('2025-03-31 00:00:00', $date->format('Y-m-d H:i:s'));

        $date->month--;

        self::assertNotEquals('2025-02-31 00:00:00', $date->format('Y-m-d H:i:s'));
        self::assertEquals('2025-03-03 00:00:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * @return void
     */
    public function testEquals(): void
    {
        $date1 = new DateTime('first day of March 2025');
        $date2 = new DateTime('first day of March 2025');

        self::assertTrue($date1 >= $date2);
        self::assertTrue($date1 <= $date2);
        self::assertEquals($date1, $date2);
    }

    /**
     * @return void
     */
    public function testGreatThen(): void
    {
        $date1 = new DateTime('first day of March 2025');
        $date2 = new DateTime();

        self::assertTrue($date2 >= $date1);
        self::assertTrue($date2 > $date1);
    }

    /**
     * @return void
     */
    public function testLessThen(): void
    {
        $date1 = new DateTime('first day of March 2025');
        $date2 = new DateTime();

        self::assertTrue($date1 <= $date2);
        self::assertTrue($date1 < $date2);
    }

}