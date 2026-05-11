<?php

declare(strict_types=1);

namespace KVEugene\DateTime\Tests\Unit;

use DateInterval;
use DateMalformedIntervalStringException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use KVEugene\DateTime\DateDuration;

/**
 *
 */
#[CoversClass(DateDuration::class)]
class DateDurationTest extends TestCase
{
    /**
     * @param string $value
     *
     * @return void
     * @throws DateMalformedIntervalStringException
     */
    #[Test]
    #[DataProvider('dataProvider')]
    public function testToString(string $value): void
    {
        $duration = new DateDuration($value);
        self::assertSame($value, (string) $duration);
    }

    /**
     * @param string $value
     *
     * @return void
     * @throws DateMalformedIntervalStringException
     */
    #[Test]
    #[DataProvider('dataProvider')]
    public function testFromInterval(string $value): void
    {
        $duration = DateDuration::createFromDateInterval(new DateInterval($value));
        self::assertSame($value, (string) $duration);
    }

    /**
     * @return array[]
     */
    public static function dataProvider(): array
    {
        return [
            // Date
            'P1Y' => ['value' => 'P1Y'],
            'P3Y' => ['value' => 'P3Y'],
            'P10Y' => ['value' => 'P10Y'],
            'P1M' => ['value' => 'P1M'],
            'P3M' => ['value' => 'P3M'],
            'P10M' => ['value' => 'P10M'],
            'P1D' => ['value' => 'P1D'],
            'P2D' => ['value' => 'P2D'],
            'P3D' => ['value' => 'P3D'],
            'P10D' => ['value' => 'P10D'],
            // Time
            'PT1H' => ['value' => 'PT1H'],
            'PT2H' => ['value' => 'PT2H'],
            'PT3H' => ['value' => 'PT3H'],
            'PT10H' => ['value' => 'PT10H'],
            'PT1M' => ['value' => 'PT1M'],
            'PT3M' => ['value' => 'PT3M'],
            'PT10M' => ['value' => 'PT10M'],
            'PT1S' => ['value' => 'PT1S'],
            'PT2S' => ['value' => 'PT2S'],
            'PT3S' => ['value' => 'PT3S'],
            'PT10S' => ['value' => 'PT10S'],
            // Combine date
            'P1Y1M' => ['value' => 'P1Y1M'],
            'P1Y12M' => ['value' => 'P1Y12M'],
            'P12Y1M' => ['value' => 'P12Y1M'],
            'P12Y12M' => ['value' => 'P12Y12M'],
            'P1Y1D' => ['value' => 'P1Y1D'],
            'P1Y12D' => ['value' => 'P1Y12D'],
            'P12Y1D' => ['value' => 'P12Y1D'],
            'P12Y12D' => ['value' => 'P12Y12D'],
            'P1M1D' => ['value' => 'P1M1D'],
            'P1M12D' => ['value' => 'P1M12D'],
            'P12M1D' => ['value' => 'P12M1D'],
            'P12M12D' => ['value' => 'P12M12D'],
            'P1Y1M1D' => ['value' => 'P1Y1M1D'],
            'P1Y1M12D' => ['value' => 'P1Y1M12D'],
            'P1Y12M1D' => ['value' => 'P1Y12M1D'],
            'P1Y12M12D' => ['value' => 'P1Y12M12D'],
            'P12Y1M1D' => ['value' => 'P12Y1M1D'],
            'P12Y1M12D' => ['value' => 'P12Y1M12D'],
            'P12Y12M1D' => ['value' => 'P12Y12M1D'],
            'P12Y12M12D' => ['value' => 'P12Y12M12D'],
            // Combine time
            'PT1H1M' => ['value' => 'PT1H1M'],
            'PT1H12M' => ['value' => 'PT1H12M'],
            'PT12H1M' => ['value' => 'PT12H1M'],
            'PT12H12M' => ['value' => 'PT12H12M'],
            'PT1H1S' => ['value' => 'PT1H1S'],
            'PT1H12S' => ['value' => 'PT1H12S'],
            'PT12H1S' => ['value' => 'PT12H1S'],
            'PT12H12S' => ['value' => 'PT12H12S'],
            'PT1M1S' => ['value' => 'PT1M1S'],
            'PT1M12S' => ['value' => 'PT1M12S'],
            'PT12M1S' => ['value' => 'PT12M1S'],
            'PT12M12S' => ['value' => 'PT12M12S'],
            // DateTime
            'P1Y1MT1H1M' => ['value' => 'P1Y1MT1H1M'],
            'P1Y12MT1H1M' => ['value' => 'P1Y12MT1H1M'],
            'P12Y1MT1H1M' => ['value' => 'P12Y1MT1H1M'],
            'P12Y12MT1H1M' => ['value' => 'P12Y12MT1H1M'],
            'P1Y1MT1H12M' => ['value' => 'P1Y1MT1H12M'],
            'P1Y1MT12H1M' => ['value' => 'P1Y1MT12H1M'],
            'P1Y1MT12H12M' => ['value' => 'P1Y1MT12H12M'],
            'P1Y1DT1H1S' => ['value' => 'P1Y1DT1H1S'],
            'P1Y12DT1H1S' => ['value' => 'P1Y12DT1H1S'],
            'P12Y1DT1H1S' => ['value' => 'P12Y1DT1H1S'],
            'P12Y12DT1H1S' => ['value' => 'P12Y12DT1H1S'],
            'P1Y1DT1H12S' => ['value' => 'P1Y1DT1H12S'],
            'P1Y1DT12H1S' => ['value' => 'P1Y1DT12H1S'],
            'P1Y1DT12H12S' => ['value' => 'P1Y1DT12H12S'],
            'P1M1DT1M1S' => ['value' => 'P1M1DT1M1S'],
            'P1M12DT1M1S' => ['value' => 'P1M12DT1M1S'],
            'P12M1DT1M1S' => ['value' => 'P12M1DT1M1S'],
            'P12M12DT1M1S' => ['value' => 'P12M12DT1M1S'],
            'P1M1DT1M12S' => ['value' => 'P1M1DT1M12S'],
            'P1M1DT12M1S' => ['value' => 'P1M1DT12M1S'],
            'P1M1DT12M12S' => ['value' => 'P1M1DT12M12S'],
            'P1Y1M1DT1H1M1S' => ['value' => 'P1Y1M1DT1H1M1S'],
            'P1Y1M1DT1H1M12S' => ['value' => 'P1Y1M1DT1H1M12S'],
            'P1Y1M1DT1H12M1S' => ['value' => 'P1Y1M1DT1H12M1S'],
            'P1Y1M1DT12H1M1S' => ['value' => 'P1Y1M1DT12H1M1S'],
            'P1Y1M12DT1H1M1S' => ['value' => 'P1Y1M12DT1H1M1S'],
            'P1Y12M1DT1H1M1S' => ['value' => 'P1Y12M1DT1H1M1S'],
            'P12Y1M1DT1H1M1S' => ['value' => 'P12Y1M1DT1H1M1S'],
            'P1Y1M1DT1H12M12S' => ['value' => 'P1Y1M1DT1H12M12S'],
            'P1Y1M1DT12H1M12S' => ['value' => 'P1Y1M1DT12H1M12S'],
            'P1Y1M12DT1H1M12S' => ['value' => 'P1Y1M12DT1H1M12S'],
            'P1Y12M1DT1H1M12S' => ['value' => 'P1Y12M1DT1H1M12S'],
            'P12Y1M1DT1H1M12S' => ['value' => 'P12Y1M1DT1H1M12S'],
        ];
    }
}
