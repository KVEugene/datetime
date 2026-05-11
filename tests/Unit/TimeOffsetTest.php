<?php

declare(strict_types=1);

namespace KVEugene\DateTime\Tests\Unit;

use DateInvalidOperationException;
use DateInvalidTimeZoneException;
use DateMalformedIntervalStringException;
use DateMalformedStringException;
use DateTimeZone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use KVEugene\DateTime\DateTime;
use KVEugene\DateTime\TimeOffset;

/**
 *
 */
#[CoversClass(TimeOffset::class)]
class TimeOffsetTest extends TestCase
{
    use TimeOffsetProvider;

    /**
     * @return void
     */
    #[Test]
    public function testSecondsBySliding(): void
    {
        self::assertEquals(1814400, new TimeOffset('3w')->seconds);
        self::assertEquals(1814400, new TimeOffset('21d')->seconds);
        self::assertEquals(1814400, new TimeOffset('504h')->seconds);
        self::assertEquals(1814400, new TimeOffset('30240m')->seconds);

        self::assertEquals(new TimeOffset('30d')->seconds, new TimeOffset('1n')->seconds);
        self::assertEquals(new TimeOffset('180d')->seconds, new TimeOffset('6n')->seconds);
    }

    /**
     * @return void
     */
    #[Test]
    public function testSecondsByCalendar(): void
    {
        $date = new DateTime('now')
            ->setTimezone(new DateTimeZone('Europe/Riga'))
            ->setTime(0, 0);

        self::assertEquals(
            new DateTime('now')->getTimestamp() - $date->getTimestamp(),
            new TimeOffset('1d Europe/Riga')->seconds
        );
    }

    /**
     * @param string $offset
     * @param string $expected
     *
     * @return void
     * @throws DateMalformedIntervalStringException
     * @throws DateInvalidTimeZoneException
     */
    #[DataProvider('provideCastToString')]
    public function testToString(string $offset, string $expected): void
    {
        self::assertEquals($expected, (string)new TimeOffset($offset));
    }

    /**
     * @param string $offset
     * @param string $expected
     *
     * @return void
     * @throws DateMalformedIntervalStringException
     * @throws DateInvalidTimeZoneException
     */
    #[DataProvider('provideCastToString')]
    public function testJsonSerialize(string $offset, string $expected): void
    {
        self::assertEquals($expected, new TimeOffset($offset)->jsonSerialize());
    }

    /**
     * @param string $offset
     * @param string $origin
     * @param string $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     */
    #[DataProvider('provideInfinities')]
    public function testIsInfinity(string $offset, string $origin, string $expected): void
    {
        $obj = new TimeOffset($offset);

        self::assertEquals($expected, $origin);
        self::assertTrue($obj->isInfinity);
        self::assertEquals(0, $obj->y);
        self::assertEquals(0, $obj->m);
        self::assertEquals(0, $obj->d);
        self::assertEquals(0, $obj->h);
        self::assertEquals(0, $obj->i);
        self::assertEquals(0, $obj->s);
        self::assertEquals(0, $obj->f);
    }

    /**
     * @param string $offset
     * @param string $origin
     * @param string $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     */
    #[DataProvider('provideOffsetWithTimeZone')]
    #[DataProvider('provideOffset')]
    public function testIsNotInfinity(string $offset, string $origin, string $expected): void
    {
        $obj = new TimeOffset($offset);

        self::assertNotEquals($expected, $origin);
        self::assertFalse($obj->isInfinity);
        self::assertTrue(
            $obj->y !== 0 || $obj->m !== 0 || $obj->d !== 0 || $obj->h !== 0 || $obj->i !== 0 || $obj->s !== 0
        );
    }

    /**
     * @param string $offset
     * @param string $origin
     * @param string $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     * @throws DateMalformedStringException
     * @throws DateInvalidOperationException
     */
    #[DataProvider('provideInfinities')]
    #[DataProvider('provideOffset')]
    #[DataProvider('provideOffsetWithTimeZone')]
    public function testGetDateFrom(string $offset, string $origin, string $expected): void
    {
        $date = new DateTime($origin, new DateTimeZone('UTC'));
        self::assertEquals($expected, new TimeOffset($offset)->getDateFrom($date)->format('Y-m-d H:i:s'));

        $date = new \DateTime($origin, new DateTimeZone('UTC'));
        self::assertEquals($expected, new TimeOffset($offset)->getDateFrom($date)->format('Y-m-d H:i:s'));
    }

    /**
     * @param string $offset
     * @param string $origin
     * @param string $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     * @throws DateMalformedStringException
     * @throws DateInvalidOperationException
     */
    #[DataProvider('provideInfinities')]
    #[DataProvider('provideOffset')]
    public function testDateSubTimeOffset(string $offset, string $origin, string $expected): void
    {
        $date = new DateTime($origin, new DateTimeZone('UTC'));
        self::assertEquals($expected, $date->sub(new TimeOffset($offset))->format('Y-m-d H:i:s'));

        $date = new \DateTime($origin, new DateTimeZone('UTC'));
        self::assertEquals($expected, $date->sub(new TimeOffset($offset))->format('Y-m-d H:i:s'));
    }

    /**
     * @param string $offset
     * @param int    $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     */
    #[DataProvider('provideYears')]
    public function testPropertyY(string $offset, int $expected): void
    {
        $obj = new TimeOffset($offset);

        self::assertEquals($expected, $obj->y);
    }

    /**
     * @param string $offset
     * @param int    $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     */
    #[DataProvider('provideMonths')]
    public function testPropertyM(string $offset, int $expected): void
    {
        $obj = new TimeOffset($offset);

        self::assertEquals($expected, $obj->m);
    }

    /**
     * @param string $offset
     * @param int    $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     */
    #[DataProvider('provideDays')]
    public function testPropertyD(string $offset, int $expected): void
    {
        $obj = new TimeOffset($offset);

        self::assertEquals($expected, $obj->d);
    }

    /**
     * @param string $offset
     * @param int    $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     */
    #[DataProvider('provideHours')]
    public function testPropertyH(string $offset, int $expected): void
    {
        $obj = new TimeOffset($offset);

        self::assertEquals($expected, $obj->h);
    }

    /**
     * @param string $offset
     * @param int    $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     */
    #[DataProvider('provideMinutes')]
    public function testPropertyI(string $offset, int $expected): void
    {
        $obj = new TimeOffset($offset);

        self::assertEquals($expected, $obj->i);
    }

    /**
     * @param string $offset
     * @param int    $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     */
    #[DataProvider('provideSeconds')]
    public function testPropertyS(string $offset, int $expected): void
    {
        $obj = new TimeOffset($offset);

        self::assertEquals($expected, $obj->s);
    }

    /**
     * @param string $offset
     * @param string $origin
     * @param string $expected
     *
     * @return void
     * @throws DateInvalidTimeZoneException
     * @throws DateMalformedIntervalStringException
     * @noinspection PhpUnusedParameterInspection
     */
    #[DataProvider('provideOffset')]
    #[DataProvider('provideOffsetWithTimeZone')]
    public function testGetSource(string $offset, string $origin, string $expected): void
    {
        $obj = new TimeOffset($offset);

        self::assertEquals($offset, $obj->source);
    }
}
