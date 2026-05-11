<?php

declare(strict_types=1);

namespace KVEugene\DateTime\Interfaces;

use DateInterval;

/**
 * Date and time interface.
 */
interface DateTimeInterface
{
    /**
     * Number of years.
     * @var int
     */
    public int $year {
        /**
         * Returns the number of years relative to the particular child of DateTimeInterface.
         * @return int Number of years
         * @noinspection PhpReturnDocTypeMismatchInspection
         */
        get;
        /**
         * Sets the number of years relative to the particular child of DateTimeInterface.
         */
        set;
    }

    /**
     * Number of months.
     * @var int
     */
    public int $month {
        /**
         * Sets the number of month relative to the particular child of DateTimeInterface.
         */
        set;
    }

    /**
     * Number of days.
     * @var int
     */
    public int $day {
        /**
         * Sets the number of days relative to the particular child of DateTimeInterface.
         */
        set;
    }

    /**
     * Number of hours.
     * @var int
     */
    public int $hour {
        /**
         * Sets the number of hours relative to the particular child of DateTimeInterface.
         */
        set;
    }

    /**
     * Number of minutes.
     * @var int
     */
    public int $minute {
        /**
         * Sets the number of minutes relative to the particular child of DateTimeInterface.
         */
        set;
    }

    /**
     * Number of seconds.
     * @var int
     */
    public int $second {
        /**
         * Sets the number of seconds relative to the particular child of DateTimeInterface.
         */
        set;
    }

    /**
     * Number of microseconds.
     * @var int
     */
    public int $microsecond {
        /**
         * Sets the number of microseconds relative to the particular child of DateTimeInterface.
         */
        set;
    }

    /**
     * Adds the specified years to the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function addYears(int $years): self;

    /**
     * Subtracts the specified years from the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function subYears(int $years): self;

    /**
     * Adds the specified months to the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function addMonths(int $months): self;

    /**
     * Subtracts the specified months from the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function subMonths(int $months): self;

    /**
     * Adds the specified days to the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function addDays(int $days): self;

    /**
     * Subtracts the specified days from the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function subDays(int $days): self;

    /**
     * Adds the specified hours to the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function addHours(int $hours): self;

    /**
     * Subtracts the specified hours from the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function subHours(int $hours): self;

    /**
     * Adds the specified minutes to the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function addMinutes(int $minutes): self;

    /**
     * Subtracts the specified minutes from the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function subMinutes(int $minutes): self;

    /**
     * Adds the specified seconds to the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function addSeconds(int $seconds): self;

    /**
     * Subtracts the specified seconds from the date.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function subSeconds(int $seconds): self;

    /**
     * Adds the specified microseconds to the date.
     *
     * @param int $microseconds Number of microseconds added.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function addMicroseconds(int $microseconds): self;

    /**
     * Subtracts the specified microseconds from the date.
     *
     * @param int $microseconds Number of microseconds subtracted.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function subMicroseconds(int $microseconds): self;

    /**
     * Sets the microseconds to a DateTime object.
     *
     * @param int $microsecond Number of milliseconds.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function setMicrosecond(int $microsecond): self;

    /**
     * Adds an amount of days, months, years, hours, minutes and seconds to a DateTime object
     *
     * @param DateInterval $interval The date and/or time duration to add.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function add(DateInterval $interval): self;

    /**
     * Subtracts an amount of days, months, years, hours, minutes and seconds from a DateTime object
     *
     * @param DateInterval $interval The date and/or time duration to subtract.
     *
     * @return static Particular child of DateTimeInterface.
     */
    public function sub(DateInterval $interval): self;
}
