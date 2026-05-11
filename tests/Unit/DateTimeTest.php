<?php

/**
 * This class is a part of Anti-fraud & Risk Extended System framework.
 *
 * @see     https://git.itechpsp.com/dev/rcs/corn
 * @author  Eugene V. Kudryavtsev<evgeny.k@itechpsps.com>
 * @version 5.0
 */

declare(strict_types = 1);

namespace KVEugene\DateTime\Tests\Unit;

use DateInterval;
use DateInvalidOperationException;
use DateMalformedIntervalStringException;
use DateMalformedStringException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use KVEugene\DateTime\DateTime;
use KVEugene\DateTime\Interfaces\DateTimeInterface;

/**
 * Tests the representation of date and time.
 */
#[CoversClass(DateTime::class)]
class DateTimeTest extends TestCase
{
    use DateTimeProvider;

    private static DateTimeInterface $date;

    /**
     * This method is called before the first test of this test class is run.
     *
     * @codeCoverageIgnore
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$date = new DateTime();
    }

    // region Tests years

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testSetYears(int $year): void
    {
        self::$date->year = $year;

        self::assertEquals($year, self::$date->year);
    }

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testSetNegativeYears(int $year): void
    {
        $year = -$year;

        self::$date->year = $year;

        self::assertEquals($year, self::$date->year);
    }

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testAddYears(int $year): void
    {
        $expected = (int)self::$date->format('Y') + $year;
        self::$date->addYears($year);

        self::assertEquals($expected, self::$date->year);
    }

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testAddNegativeYears(int $year): void
    {
        $year = -$year;
        $expected = (int)self::$date->format('Y') + $year;
        self::$date->addYears($year);

        self::assertEquals($expected, self::$date->year);
    }

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testIncrementYears(int $year): void
    {
        $expected         = (int)self::$date->format('Y') + $year;
        self::$date->year += $year;

        self::assertEquals($expected, self::$date->year);
    }

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testIncrementNegativeYears(int $year): void
    {
        $year = -$year;
        $expected         = (int)self::$date->format('Y') + $year;
        self::$date->year += $year;

        self::assertEquals($expected, self::$date->year);
    }

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testSubYears(int $year): void
    {
        $expected = (int)self::$date->format('Y') - $year;
        self::$date->subYears($year);

        self::assertEquals($expected, self::$date->year);
    }

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testSubNegativeYears(int $year): void
    {
        $year = -$year;
        $expected = (int)self::$date->format('Y') - $year;
        self::$date->subYears($year);

        self::assertEquals($expected, self::$date->year);
    }

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testDecrementYears(int $year): void
    {
        $expected         = (int)self::$date->format('Y') - $year;
        self::$date->year -= $year;

        self::assertEquals($expected, self::$date->year);
    }

    /**
     * @param int $year
     *
     * @return void
     */
    #[Test]
    #[DataProvider('yearsProvider')]
    public function testDecrementNegativeYears(int $year): void
    {
        $year = -$year;

        $expected         = (int)self::$date->format('Y') - $year;
        self::$date->year -= $year;

        self::assertEquals($expected, self::$date->year);
    }
    // endregion

    // region Tests months
    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testSetMonths(int $month): void
    {
        self::$date->month = $month;
        $expected          = $month % 12;
        if ($expected <= 0) {
            $expected += 12;
        }
        self::assertEquals($expected, self::$date->month);
    }

    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testSetNegativeMonths(int $month): void
    {
        self::$date = new DateTime();
        $month      = -$month;

        self::$date->month = $month;
        $expected = $month % 12;
        if ($expected <= 0) {
            $expected += 12;
        }
        self::assertEquals($expected, self::$date->month);
    }

    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testAddMonths(int $month): void
    {
        $expected = ((int)self::$date->format('m') + $month) % 12;
        if ($expected <= 0) {
            $expected += 12;
        }
        self::$date->addMonths($month);

        self::assertEquals($expected, self::$date->month);
    }

    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testAddNegativeMonths(int $month): void
    {
        $month = -$month;
        $expected = ((int)self::$date->format('m') + $month) % 12;
        if ($expected <= 0) {
            $expected += 12;
        }

        $message = sprintf('Current month: %s, Growth: %s', self::$date->format('m'), $month);

        self::$date->addMonths($month);

        $message .= sprintf(', Expectation: %s, Result: %s', $expected, self::$date->month);

        self::assertEquals($expected, self::$date->month, $message);
    }

    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testIncrementMonths(int $month): void
    {
        $expected = ((int)self::$date->format('m') + $month) % 12;
        if ($expected <= 0) {
            $expected += 12;
        }

        $message = sprintf('Current month: %s, Growth: %s', self::$date->format('m'), $month);

        self::$date->month += $month;

        $message .= sprintf(', Expectation: %s, Result: %s', $expected, self::$date->month);

        self::assertEquals($expected, self::$date->month, $message);
    }

    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testIncrementNegativeMonths(int $month): void
    {
        self::$date = new DateTime();
        $month      = -$month;

        $expected = ((int)self::$date->format('m') + $month) % 12;
        if ($expected <= 0) {
            $expected += 12;
        }
        $message = sprintf('Current month: %s, Growth: %s', self::$date->format('m'), $month);

        self::$date->month += $month;

        $message .= sprintf(', Expectation: %s, Result: %s', $expected, self::$date->month);

        self::assertEquals($expected, self::$date->month, $message);
    }

    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testSubMonths(int $month): void
    {
        $expected = ((int)self::$date->format('m') - $month) % 12;
        if ($expected <= 0) {
            $expected += 12;
        }
        self::$date->subMonths($month);

        self::assertEquals($expected, self::$date->month);
    }

    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testSubNegativeMonths(int $month): void
    {
        $month = -$month;
        $expected = ((int)self::$date->format('m') - $month) % 12;
        if ($expected <= 0) {
            $expected += 12;
        }
        self::$date->subMonths($month);

        self::assertEquals($expected, self::$date->month);
    }

    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testDecrementMonths(int $month): void
    {
        $expected = ((int)self::$date->format('m') - $month) % 12;
        if ($expected <= 0) {
            $expected += 12;
        }
        self::$date->month -= $month;

        self::assertEquals($expected, self::$date->month);
    }

    /**
     * @param int $month
     *
     * @return void
     */
    #[Test]
    #[DataProvider('monthsProvider')]
    public function testDecrementNegativeMonths(int $month): void
    {
        self::$date = new DateTime();
        $month      = -$month;

        $expected = ((int)self::$date->format('m') - $month) % 12;
        if ($expected <= 0) {
            $expected += 12;
        }
        self::$date->month -= $month;

        self::assertEquals($expected, self::$date->month);
    }
    // endregion

    // region Tests days
    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testSetDays(int $day): void
    {
        $date      = clone(self::$date);
        $expected  = $this->getRealDay($date, $day);
        $date->day = $day;

        self::assertEquals($expected, $date->day);
    }

    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testSetNegativeDays(int $day): void
    {
        $date     = clone(self::$date);
        $day      = -$day;
        $expected = $this->getRealDay($date, $day);

        $date->day = $day;

        self::assertEquals($expected, $date->day);
    }

    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testAddDays(int $day): void
    {
        $date     = clone(self::$date);
        $expected = $this->getRealDay($date, (int)$date->format('d') + $day);
        $date->addDays($day);

        self::assertEquals($expected, $date->day);
    }

    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testAddNegativeDays(int $day): void
    {
        $day      = -$day;
        $date     = clone(self::$date);
        $expected = $this->getRealDay($date, (int)$date->format('d') + $day);
        $date->addDays($day);

        self::assertEquals($expected, $date->day);
    }

    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testIncrementDays(int $day): void
    {
        $date      = clone(self::$date);
        $expected  = $this->getRealDay($date, (int)$date->format('d') + $day);
        $date->day += $day;

        self::assertEquals($expected, $date->day);
    }

    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testIncrementNegativeDays(int $day): void
    {
        $date = clone(self::$date);
        $day  = -$day;

        $expected  = $this->getRealDay($date, (int)$date->format('d') + $day);
        $date->day += $day;

        self::assertEquals($expected, $date->day);
    }

    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testSubDays(int $day): void
    {
        $date     = clone(self::$date);
        $expected = $this->getRealDay($date, (int)$date->format('d') - $day);
        $date->subDays($day);

        self::assertEquals($expected, $date->day);
    }

    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testSubNegativeDays(int $day): void
    {
        $day      = -$day;
        $date     = clone(self::$date);
        $expected = $this->getRealDay($date, (int)$date->format('d') - $day);
        $date->subDays($day);

        self::assertEquals($expected, $date->day);
    }

    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testDecrementDays(int $day): void
    {
        $date      = clone(self::$date);
        $expected  = $this->getRealDay($date, (int)$date->format('d') - $day);
        $date->day -= $day;

        self::assertEquals($expected, $date->day);
    }

    /**
     * @param int $day
     *
     * @return void
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('daysProvider')]
    public function testDecrementNegativeDays(int $day): void
    {
        $date = clone(self::$date);
        $day  = -$day;

        $expected  = $this->getRealDay($date, (int)$date->format('d') - $day);
        $date->day -= $day;

        self::assertEquals($expected, $date->day);
    }
    // endregion

    // region Tests hours
    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testSetHours(int $hour): void
    {
        self::$date->hour = $hour;
        $expected         = $hour % 24;

        self::assertEquals($expected, self::$date->hour);
    }

    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testSetNegativeHours(int $hour): void
    {
        $hour = -$hour;

        $expected = $hour % 24;
        if ($expected < 0) {
            $expected += 24;
        }
        self::$date->hour = $hour;

        self::assertEquals($expected, self::$date->hour);
    }

    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testAddHours(int $hour): void
    {
        $expected = ((int)self::$date->format('H') + $hour) % 24;
        self::$date->addHours($hour);

        self::assertEquals($expected, self::$date->hour);
    }

    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testAddNegativeHours(int $hour): void
    {
        $hour = -$hour;
        $expected = ((int)self::$date->format('H') + $hour) % 24;
        if ($expected < 0) {
            $expected += 24;
        }
        self::$date->addHours($hour);

        self::assertEquals($expected, self::$date->hour);
    }

    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testIncrementHours(int $hour): void
    {
        $expected         = ((int)self::$date->format('H') + $hour) % 24;
        self::$date->hour += $hour;

        self::assertEquals($expected, self::$date->hour);
    }

    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testIncrementNegativeHours(int $hour): void
    {
        $hour = -$hour;

        $expected = ((int)self::$date->format('H') + $hour) % 24;
        if ($expected < 0) {
            $expected += 24;
        }
        self::$date->hour += $hour;

        self::assertEquals($expected, self::$date->hour);
    }

    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testSubHours(int $hour): void
    {
        $expected = ((int)self::$date->format('H') - $hour) % 24;
        if ($expected < 0) {
            $expected += 24;
        }
        self::$date->subHours($hour);

        self::assertEquals($expected, self::$date->hour);
    }

    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testSubNegativeHours(int $hour): void
    {
        $hour = -$hour;
        $expected = ((int)self::$date->format('H') - $hour) % 24;
        if ($expected < 0) {
            $expected += 24;
        }
        self::$date->subHours($hour);

        self::assertEquals($expected, self::$date->hour);
    }

    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testDecrementHours(int $hour): void
    {
        $expected = ((int)self::$date->format('H') - $hour) % 24;
        if ($expected < 0) {
            $expected += 24;
        }
        self::$date->hour -= $hour;

        self::assertEquals($expected, self::$date->hour);
    }

    /**
     * @param int $hour
     *
     * @return void
     */
    #[Test]
    #[DataProvider('hoursProvider')]
    public function testDecrementNegativeHours(int $hour): void
    {
        $hour = -$hour;

        $expected = ((int)self::$date->format('H') - $hour) % 24;
        if ($expected < 0) {
            $expected += 24;
        }
        self::$date->hour -= $hour;

        self::assertEquals($expected, self::$date->hour);
    }
    // endregion

    // region Tests minutes
    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testSetMinutes(int $minute): void
    {
        self::$date->minute = $minute;
        $expected           = $minute % 60;

        self::assertEquals($expected, self::$date->minute);
    }

    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testSetNegativeMinutes(int $minute): void
    {
        self::$date = new DateTime();
        $minute     = -$minute;

        $expected = $minute % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->minute = $minute;

        self::assertEquals($expected, self::$date->minute);
    }

    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testAddMinutes(int $minute): void
    {
        $expected = ((int)self::$date->format('i') + $minute) % 60;
        self::$date->addMinutes($minute);

        self::assertEquals($expected, self::$date->minute);
    }

    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testAddNegativeMinutes(int $minute): void
    {
        $minute = -$minute;
        $expected = ((int)self::$date->format('i') + $minute) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->addMinutes($minute);

        self::assertEquals($expected, self::$date->minute);
    }

    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testIncrementMinutes(int $minute): void
    {
        $expected           = ((int)self::$date->format('i') + $minute) % 60;
        self::$date->minute += $minute;

        self::assertEquals($expected, self::$date->minute);
    }

    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testIncrementNegativeMinutes(int $minute): void
    {
        self::$date = new DateTime();
        $minute     = -$minute;

        $expected = ((int)self::$date->format('i') + $minute) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->minute += $minute;

        self::assertEquals($expected, self::$date->minute);
    }

    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testSubMinutes(int $minute): void
    {
        $expected = ((int)self::$date->format('i') - $minute) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->subMinutes($minute);

        self::assertEquals($expected, self::$date->minute);
    }

    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testSubNegativeMinutes(int $minute): void
    {
        $minute = -$minute;
        $expected = ((int)self::$date->format('i') - $minute) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->subMinutes($minute);

        self::assertEquals($expected, self::$date->minute);
    }

    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testDecrementMinutes(int $minute): void
    {
        $expected = ((int)self::$date->format('i') - $minute) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->minute -= $minute;

        self::assertEquals($expected, self::$date->minute);
    }

    /**
     * @param int $minute
     *
     * @return void
     */
    #[Test]
    #[DataProvider('minutesProvider')]
    public function testDecrementNegativeMinutes(int $minute): void
    {
        self::$date = new DateTime();
        $minute     = -$minute;

        $expected = ((int)self::$date->format('i') - $minute) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->minute -= $minute;

        self::assertEquals($expected, self::$date->minute);
    }
    // endregion

    // region Tests seconds
    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testSetSeconds(int $second): void
    {
        self::$date->second = $second;
        $expected           = $second % 60;

        self::assertEquals($expected, self::$date->second);
    }

    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testSetNegativeSeconds(int $second): void
    {
        self::$date = new DateTime();
        $second     = -$second;

        $expected = $second % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->second = $second;

        self::assertEquals($expected, self::$date->second);
    }

    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testAddSeconds(int $second): void
    {
        $expected = ((int)self::$date->format('s') + $second) % 60;
        self::$date->addSeconds($second);

        self::assertEquals($expected, self::$date->second);
    }

    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testAddNegativeSeconds(int $second): void
    {
        $second = -$second;
        $expected = ((int)self::$date->format('s') + $second) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->addSeconds($second);

        self::assertEquals($expected, self::$date->second);
    }

    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testIncrementSeconds(int $second): void
    {
        $expected           = ((int)self::$date->format('s') + $second) % 60;
        self::$date->second += $second;

        self::assertEquals($expected, self::$date->second);
    }

    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testIncrementNegativeSeconds(int $second): void
    {
        self::$date = new DateTime();
        $second     = -$second;

        $expected = ((int)self::$date->format('s') + $second) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->second += $second;

        self::assertEquals($expected, self::$date->second);
    }

    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testSubSeconds(int $second): void
    {
        $expected = ((int)self::$date->format('s') - $second) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->subSeconds($second);

        self::assertEquals($expected, self::$date->second);
    }

    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testSubNegativeSeconds(int $second): void
    {
        $second = -$second;
        $expected = ((int)self::$date->format('s') - $second) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->subSeconds($second);

        self::assertEquals($expected, self::$date->second);
    }

    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testDecrementSeconds(int $second): void
    {
        $expected = ((int)self::$date->format('s') - $second) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->second -= $second;

        self::assertEquals($expected, self::$date->second);
    }

    /**
     * @param int $second
     *
     * @return void
     */
    #[Test]
    #[DataProvider('secondsProvider')]
    public function testDecrementNegativeSeconds(int $second): void
    {
        self::$date = new DateTime();
        $second     = -$second;

        $expected = ((int)self::$date->format('s') - $second) % 60;
        if ($expected < 0) {
            $expected += 60;
        }
        self::$date->second -= $second;

        self::assertEquals($expected, self::$date->second);
    }
    // endregion

    // region Tests microseconds
    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testSetMicroseconds(int $microsecond): void
    {
        self::$date->microsecond = $microsecond;
        $expected                = $microsecond % 1000000;

        self::assertEquals($expected, self::$date->microsecond);
    }

    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testSetNegativeMicroseconds(int $microsecond): void
    {
        self::$date = new DateTime();
        $microsecond     = -$microsecond;

        $expected = $microsecond % 1000000;
        if ($expected < 0) {
            $expected += 1000000;
        }
        self::$date->microsecond = $microsecond;

        self::assertEquals($expected, self::$date->microsecond);
    }

    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testAddMicroseconds(int $microsecond): void
    {
        $expected = ((int)self::$date->format('u') + $microsecond) % 1000000;
        self::$date->addMicroseconds($microsecond);

        self::assertEquals($expected, self::$date->microsecond);
    }

    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testAddNegativeMicroseconds(int $microsecond): void
    {
        $microsecond = -$microsecond;
        $expected = ((int)self::$date->format('u') + $microsecond) % 1000000;
        if ($expected < 0) {
            $expected += 1000000;
        }

        $message = sprintf('Current microseconds: %s, Growth: %s', self::$date->format('u'), $microsecond);

        self::$date->addMicroseconds($microsecond);

        $message .= sprintf(', Expectation: %s, Result: %s', $expected, self::$date->microsecond);

        self::assertEquals($expected, self::$date->microsecond, $message);
    }

    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testIncrementMicroseconds(int $microsecond): void
    {
        $expected           = ((int)self::$date->format('u') + $microsecond) % 1000000;
        self::$date->microsecond += $microsecond;

        self::assertEquals($expected, self::$date->microsecond);
    }

    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testIncrementNegativeMicroseconds(int $microsecond): void
    {
        self::$date = new DateTime();
        $microsecond     = -$microsecond;

        $expected = ((int)self::$date->format('u') + $microsecond) % 1000000;
        if ($expected < 0) {
            $expected += 1000000;
        }
        self::$date->microsecond += $microsecond;

        self::assertEquals($expected, self::$date->microsecond);
    }

    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testSubMicroseconds(int $microsecond): void
    {
        $expected = ((int)self::$date->format('u') - $microsecond) % 1000000;
        if ($expected < 0) {
            $expected += 1000000;
        }
        self::$date->subMicroseconds($microsecond);

        self::assertEquals($expected, self::$date->microsecond);
    }

    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testSubNegativeMicroseconds(int $microsecond): void
    {
        $microsecond = -$microsecond;
        $expected = ((int)self::$date->format('u') - $microsecond) % 1000000;
        self::$date->subMicroseconds($microsecond);

        self::assertEquals($expected, self::$date->microsecond);
    }

    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testDecrementMicroseconds(int $microsecond): void
    {
        $expected = ((int)self::$date->format('u') - $microsecond) % 1000000;
        if ($expected < 0) {
            $expected += 1000000;
        }
        self::$date->microsecond -= $microsecond;

        self::assertEquals($expected, self::$date->microsecond);
    }

    /**
     * @param int $microsecond
     *
     * @return void
     */
    #[Test]
    #[DataProvider('microsecondsProvider')]
    public function testDecrementNegativeMicroseconds(int $microsecond): void
    {
        self::$date = new DateTime();
        $microsecond     = -$microsecond;

        $expected = ((int)self::$date->format('u') - $microsecond) % 1000000;
        if ($expected < 0) {
            $expected += 1000000;
        }
        self::$date->microsecond -= $microsecond;

        self::assertEquals($expected, self::$date->microsecond);
    }
    // endregion

    // region Tests readonly properties

    /**
     * @param string $date
     * @param int    $expected
     *
     * @return void
     * @throws DateMalformedStringException
     */
    #[Test]
    #[DataProvider('dayLastProvider')]
    public function testLastMonthDay(string $date, int $expected): void
    {
        $date = new DateTime($date);

        self::assertEquals($expected, $date->lastDay);
    }

    /**
     * @param string $date
     * @param int    $expected
     *
     * @return void
     * @throws DateMalformedStringException
     */
    #[Test]
    #[DataProvider('quarterProvider')]
    public function testQuarter(string $date, int $expected): void
    {
        $date = new DateTime($date);

        self::assertEquals($expected, $date->quarter);
    }

    /**
     * @param string $date
     * @param int    $expected
     *
     * @return void
     * @throws DateMalformedStringException
     */
    #[Test]
    #[DataProvider('halfYearProvider')]
    public function testHalfYear(string $date, int $expected): void
    {
        $date = new DateTime($date);

        self::assertEquals($expected, $date->half);
    }

    /**
     * @param string $date
     * @param int    $expected
     *
     * @return void
     * @throws DateMalformedStringException
     */
    #[Test]
    #[DataProvider('weekdayProvider')]
    public function testWeekday(string $date, int $expected): void
    {
        $date = new DateTime($date);

        self::assertEquals($expected, $date->weekday);
    }
    // endregion


    /**
     * @return void
     */
    #[Test]
    public function testStringable(): void
    {
        $date = new DateTime('2025-04-15T14:11:52.289314Z');

        $date->format = 'Y-m-d';
        self::assertEquals('2025-04-15', (string) $date);
        self::assertEquals('2025-04-15', $date->jsonSerialize());

        $date->format = 'This is a strange format!';
        self::assertEquals('Z021152 1152 pm 5230Tue, 15 Apr 2025 14:11:52 +0000pm42Z f2025Tue, 15 Apr 2025 14:11:52 +000004pm30!', (string) $date);
        self::assertEquals('Z021152 1152 pm 5230Tue, 15 Apr 2025 14:11:52 +0000pm42Z f2025Tue, 15 Apr 2025 14:11:52 +000004pm30!', $date->jsonSerialize());
    }

    /**
     * @param string $date1
     * @param string $date2
     * @param string $expected
     *
     * @return void
     * @throws DateMalformedStringException
     * @throws DateMalformedIntervalStringException
     */
    #[Test]
    #[DataProvider('diffDatesProvider')]
    public function testDifference(string $date1, string $date2, string $expected): void
    {
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);
        $diff  = $date1->diff($date2);

        self::assertEquals($expected, (string)$diff);
    }

    /**
     * @param string       $date
     * @param DateInterval $interval
     * @param string       $expected
     *
     * @return void
     * @throws DateMalformedStringException
     */
    #[Test]
    #[DataProvider('addIntervalProvider')]
    public function testAdd(string $date, DateInterval $interval, string $expected): void
    {
        $date = new DateTime($date);
        $date->add($interval);

        self::assertEquals($expected, $date->format('Y-m-d H:i:s'));
    }

    /**
     * @param string       $date
     * @param DateInterval $interval
     * @param string       $expected
     *
     * @return void
     * @throws DateMalformedStringException
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('subIntervalProvider')]
    public function testSub(string $date, DateInterval $interval, string $expected): void
    {
        $date = new DateTime($date);
        $date->sub($interval);

        self::assertEquals($expected, $date->format('Y-m-d H:i:s'));
    }

    /**
     * @param string       $date
     * @param DateInterval $interval
     * @param string       $expected
     *
     * @return void
     * @throws DateMalformedStringException
     */
    #[Test]
    #[DataProvider('addIntervalMicrotimeProvider')]
    public function testAddMicrotime(string $date, DateInterval $interval, string $expected): void
    {
        $date = new DateTime($date);
        $date->add($interval);

        self::assertEquals($expected, $date->format('Y-m-d H:i:s.u'));
    }

    /**
     * @param string       $date
     * @param DateInterval $interval
     * @param string       $expected
     *
     * @return void
     * @throws DateMalformedStringException
     * @throws DateInvalidOperationException
     */
    #[Test]
    #[DataProvider('subIntervalMicrotimeProvider')]
    public function testSubMicrotime(string $date, DateInterval $interval, string $expected): void
    {
        $date = new DateTime($date);
        $date->sub($interval);

        self::assertEquals($expected, $date->format('Y-m-d H:i:s.u'));
    }

    /**
     * @param DateTime $date
     * @param int      $current
     *
     * @return int
     * @throws DateInvalidOperationException
     */
    private function getRealDay(DateTime $date, int $current): int
    {
        $internal = clone($date);

        switch ($current) {
        case 0:
            $expected = (int)$internal->sub(new DateInterval('P1M'))->format('t');
            break;
        case $current > (int)$internal->format('t'):
            $current  -= (int)$internal->format('t');
            $expected = $this->getRealDay($internal->add(new DateInterval('P1M')), $current);
            break;
        case $current < 0:
            $internal->sub(new DateInterval('P1M'));
            $expected = $this->getRealDay($internal, (int)$internal->format('t') + $current);
            break;
        default:
            $expected = $current;
        }

        return $expected;
    }
}
