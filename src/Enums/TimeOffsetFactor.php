<?php

declare(strict_types=1);

namespace KVEugene\DateTime\Enums;

/**
 *
 */
enum TimeOffsetFactor: int
{
    /**
     * Time offset factor in seconds.
     */
    case Second = 0;

    /**
     * Time offset factor in minutes.
     */
    case Minute = 1;

    /**
     * Time offset factor in hours.
     */
    case Hour = 2;

    /**
     * Time offset factor in days.
     */
    case Day = 3;

    /**
     * Time offset factor in weeks.
     */
    case Week = 4;

    /**
     * Time offset factor in months.
     */
    case Month = 5;

    /**
     * Time offset factor in quarters.
     */
    case Quarter = 6;

    /**
     * Time offset factor in years.
     */
    case Year = 7;

    private const array PATTERN = [
        's' => self::Second,
        'm' => self::Minute,
        'h' => self::Hour,
        'd' => self::Day,
        'w' => self::Week,
        'n' => self::Month,
        'q' => self::Quarter,
        'y' => self::Year,
    ];

    /**
     * @param string $source
     *
     * @return TimeOffsetFactor
     */
    public static function fromSource(string $source): self
    {
        $source = strtolower(trim($source));
        return array_key_exists($source, self::PATTERN)
            ? self::PATTERN[$source]
            : self::Second;
    }

    /**
     * @return bool
     */
    public function isTime(): bool
    {
        return $this->value <= 2;
    }

    /**
     * @param int $factor
     *
     * @return string
     */
    public function format(int $factor): string
    {
        $result = 'P' . ($this->isTime() ? 'T' : '');

        return match ($this) {
            self::Year => $result . $factor . 'Y',
            self::Quarter => $result . $factor * 3 . 'M',
            self::Month, self::Minute => $result . $factor . 'M',
            self::Week => $result . $factor * 7 . 'D',
            self::Day => $result . $factor . 'D',
            self::Hour => $result . $factor . 'H',
            default => $result . $factor . 'S',
        };
    }
}
