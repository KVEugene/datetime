<?php

declare(strict_types=1);

namespace KVEugene\DateTime\Interfaces;

use DateTimeZone;
use KVEugene\DateTime\Enums\TimeOffsetFactor;

/**
 * Time offset interface.
 */
interface TimeOffsetInterface
{
    /**
     * The initial offset value.
     * @var string
     */
    public string $source {
        /**
         * Returns the initial offset value.
         */
        get;
    }

    /**
     * Total number of seconds the interval spans.
     *
     * @var int
     */
    public int $seconds {
        /**
         * Returns the number of seconds in the datetime interval.
         * @return int The number of seconds in the datetime interval.
         * @noinspection PhpReturnDocTypeMismatchInspection PhpStorm wrong return type hints.
         */
        get;
    }

    /**
     * Indicator that the offset is in calendar mode.
     *
     * @var bool {@see true TRUE} if the offset is in the calendar mode, {@see false FALSE} if the offset is in the sliding mode.
     */
    public bool $byCalendar {
        /**
         * Returns an indicator that the offset is in calendar mode.
         * @return bool {@see true TRUE} if the offset is in the calendar mode, {@see false FALSE} if the offset is in the sliding mode.
         * @noinspection PhpReturnDocTypeMismatchInspection PhpStorm wrong return type hints.
         */
        get;
    }

    /**
     * The indicator by offset is infinity.
     *
     * @var bool {@see true TRUE} if the offset is infinity, {@see false FALSE} otherwise.
     * @virtual
     */
    public bool $isInfinity {
        /**
         * Returns the result of checking whether the offset is infinite.
         */
        get;
    }

    /**
     * Time offset type.
     *
     * @var TimeOffsetFactor
     */
    public TimeOffsetFactor $intervalType {
        /**
         * Returns the time offset type.
         */
        get;
    }

    /**
     * Specified time zone.
     *
     * @var DateTimeZone|null Object for a calendar mode of the offset or {@see null NULL} for a sliding mode.
     */
    public ?DateTimeZone $timeZone {
        /**
         * Returns the specified time zone for a calendar mode of the offset.
         */
        get;
    }

    /**
     * Converts a date to the start date of the interval and returns the result.
     *
     * @param \DateTimeInterface $dateTime Initial date
     * @return \DateTimeInterface Converted date
     */
    public function getDateFrom(\DateTimeInterface $dateTime): \DateTimeInterface;
}
