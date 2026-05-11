<?php

declare(strict_types = 1);

namespace KVEugene\DateTime\Tests\Unit\Enums;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use KVEugene\DateTime\Enums\TimeOffsetFactor;

/**
 *
 */
#[CoversClass(TimeOffsetFactor::class)]
class TimeOffsetFactorTest extends TestCase
{
    /**
     * @return array[]
     */
    public static function sourceProvider(): array
    {
        return [
            'Blank string'  => ['source' => '', 'expected' => TimeOffsetFactor::Second],
            'Capital S'     => ['source' => 'S', 'expected' => TimeOffsetFactor::Second],
            'Capital M'     => ['source' => 'M', 'expected' => TimeOffsetFactor::Minute],
            'Capital H'     => ['source' => 'H', 'expected' => TimeOffsetFactor::Hour],
            'Capital D'     => ['source' => 'D', 'expected' => TimeOffsetFactor::Day],
            'Capital W'     => ['source' => 'W', 'expected' => TimeOffsetFactor::Week],
            'Capital N'     => ['source' => 'N', 'expected' => TimeOffsetFactor::Month],
            'Capital Q'     => ['source' => 'Q', 'expected' => TimeOffsetFactor::Quarter],
            'Capital Y'     => ['source' => 'Y', 'expected' => TimeOffsetFactor::Year],
            'Lowercase s'   => ['source' => 's', 'expected' => TimeOffsetFactor::Second],
            'Lowercase m'   => ['source' => 'm', 'expected' => TimeOffsetFactor::Minute],
            'Lowercase h'   => ['source' => 'h', 'expected' => TimeOffsetFactor::Hour],
            'Lowercase d'   => ['source' => 'd', 'expected' => TimeOffsetFactor::Day],
            'Lowercase w'   => ['source' => 'w', 'expected' => TimeOffsetFactor::Week],
            'Lowercase n'   => ['source' => 'n', 'expected' => TimeOffsetFactor::Month],
            'Lowercase q'   => ['source' => 'q', 'expected' => TimeOffsetFactor::Quarter],
            'Lowercase y'   => ['source' => 'y', 'expected' => TimeOffsetFactor::Year],
            'Custom string' => ['source' => 'Half past nine', 'expected' => TimeOffsetFactor::Second],
        ];
    }

    /**
     * @return array[]
     */
    public static function isTimeProvider(): array
    {
        return [
            'Seconds' => ['factor' => TimeOffsetFactor::Second],
            'Minutes' => ['factor' => TimeOffsetFactor::Minute],
            'Hours'   => ['factor' => TimeOffsetFactor::Hour],
        ];
    }

    /**
     * @return array[]
     */
    public static function isNotTimeProvider(): array
    {
        return [
            'Days'     => ['factor' => TimeOffsetFactor::Day],
            'Weeks'    => ['factor' => TimeOffsetFactor::Week],
            'Months'   => ['factor' => TimeOffsetFactor::Month],
            'Quarters' => ['factor' => TimeOffsetFactor::Quarter],
            'Years'    => ['factor' => TimeOffsetFactor::Year],
        ];
    }

    /**
     * @return array[]
     */
    public static function factorFormatProvider(): array
    {
        return [
            '0 seconds'   => ['factor' => TimeOffsetFactor::Second, 'value' => 0, 'expected' => 'PT0S'],
            '1 second'    => ['factor' => TimeOffsetFactor::Second, 'value' => 1, 'expected' => 'PT1S'],
            '654 seconds' => ['factor' => TimeOffsetFactor::Second, 'value' => 654, 'expected' => 'PT654S'],

            '0 minutes'   => ['factor' => TimeOffsetFactor::Minute, 'value' => 0, 'expected' => 'PT0M'],
            '1 minute'    => ['factor' => TimeOffsetFactor::Minute, 'value' => 1, 'expected' => 'PT1M'],
            '654 minutes' => ['factor' => TimeOffsetFactor::Minute, 'value' => 654, 'expected' => 'PT654M'],

            '0 hours'   => ['factor' => TimeOffsetFactor::Hour, 'value' => 0, 'expected' => 'PT0H'],
            '1 hour'    => ['factor' => TimeOffsetFactor::Hour, 'value' => 1, 'expected' => 'PT1H'],
            '654 hours' => ['factor' => TimeOffsetFactor::Hour, 'value' => 654, 'expected' => 'PT654H'],

            '0 days'   => ['factor' => TimeOffsetFactor::Day, 'value' => 0, 'expected' => 'P0D'],
            '1 day'    => ['factor' => TimeOffsetFactor::Day, 'value' => 1, 'expected' => 'P1D'],
            '654 days' => ['factor' => TimeOffsetFactor::Day, 'value' => 654, 'expected' => 'P654D'],

            '0 weeks'   => ['factor' => TimeOffsetFactor::Week, 'value' => 0, 'expected' => 'P0D'],
            '1 week'    => ['factor' => TimeOffsetFactor::Week, 'value' => 1, 'expected' => 'P7D'],
            '654 weeks' => ['factor' => TimeOffsetFactor::Week, 'value' => 654, 'expected' => 'P4578D'],

            '0 months'   => ['factor' => TimeOffsetFactor::Month, 'value' => 0, 'expected' => 'P0M'],
            '1 month'    => ['factor' => TimeOffsetFactor::Month, 'value' => 1, 'expected' => 'P1M'],
            '654 months' => ['factor' => TimeOffsetFactor::Month, 'value' => 654, 'expected' => 'P654M'],

            '0 quarters'   => ['factor' => TimeOffsetFactor::Quarter, 'value' => 0, 'expected' => 'P0M'],
            '1 quarter'    => ['factor' => TimeOffsetFactor::Quarter, 'value' => 1, 'expected' => 'P3M'],
            '654 quarters' => ['factor' => TimeOffsetFactor::Quarter, 'value' => 654, 'expected' => 'P1962M'],

            '0 years'   => ['factor' => TimeOffsetFactor::Year, 'value' => 0, 'expected' => 'P0Y'],
            '1 year'    => ['factor' => TimeOffsetFactor::Year, 'value' => 1, 'expected' => 'P1Y'],
            '654 years' => ['factor' => TimeOffsetFactor::Year, 'value' => 654, 'expected' => 'P654Y'],
        ];
    }

    /**
     * @param string           $source
     * @param TimeOffsetFactor $expected
     *
     * @return void
     */
    #[Test]
    #[DataProvider('sourceProvider')]
    public function testFromSource(string $source, TimeOffsetFactor $expected): void
    {
        $factor = TimeOffsetFactor::fromSource($source);

        self::assertEquals($expected, $factor);
    }

    /**
     * @param TimeOffsetFactor $factor
     *
     * @return void
     */
    #[Test]
    #[DataProvider('isTimeProvider')]
    public function testIsTime(TimeOffsetFactor $factor): void
    {
        self::assertTrue($factor->isTime());
    }

    /**
     * @param TimeOffsetFactor $factor
     *
     * @return void
     */
    #[Test]
    #[DataProvider('isNotTimeProvider')]
    public function testIsNotATime(TimeOffsetFactor $factor): void
    {
        self::assertFalse($factor->isTime());
    }

    /**
     * @param TimeOffsetFactor $factor
     * @param int              $value
     * @param string           $expected
     *
     * @return void
     */
    #[Test]
    #[DataProvider('factorFormatProvider')]
    public function testFormat(TimeOffsetFactor $factor, int $value, string $expected): void
    {
        self::assertEquals($expected, $factor->format($value));
    }
}
