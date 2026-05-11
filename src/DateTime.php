<?php

declare(strict_types = 1);

namespace KVEugene\DateTime;

use DateInterval;
use DateInvalidOperationException;
use DateMalformedIntervalStringException;
use DateMalformedStringException;
use DateTime as PhpDateTime;
use DateTimeZone;
use JsonSerializable;
use Stringable;
use KVEugene\DateTime\Enums\TimeOffsetFactor;
use KVEugene\DateTime\Interfaces\DateTimeInterface;
use KVEugene\DateTime\Interfaces\TimeOffsetInterface;

use const DATE_RFC3339_EXTENDED;

/**
 * Representation of date and time.
 *
 * @noinspection PhpLackOfCohesionInspection
 */
class DateTime extends PhpDateTime implements DateTimeInterface, Stringable, JsonSerializable
{
    /**
     * Number of years.
     * @var int
     * @virtual
     */
    public int $year {
        /**
         * Returns the number of years relative to the current date and time object.
         *
         * @return int
         */
        get => (int)$this->format('Y');
        /**
         * Sets the number of years into the current date and time object.
         *
         * @param int $years Number of years.
         *
         * @return void
         */
        set (int $years) {
            $current = (int)$this->format('Y');

            switch (true) {
                case $years > $current:
                    $this->addYears($years - $current);
                    break;
                case $years < $current:
                    $this->subYears($current - $years);
                    break;
            }
        }
    }

    /**
     * Number of months.
     * @var int
     * @virtual
     */
    public int $month {
        /**
         * Returns the number of months relative to the current date and time object.
         * @return int
         */
        get => (int)$this->format('m');
        /**
         * Sets the number of months into the current date and time object.
         *
         * __ATTENTION!__
         *
         * A month cannot be equal to zero. Therefore, all manipulations with assigning a value of 0 mean moving to the
         * previous month, and assigning negative values increases by 1.
         *
         * Example:
         * ```
         * $date = new DateTime(); // Current date: 12 April 2025.
         * // -> 2025-04-12
         *
         * $date->month = 1;  // Set month to 1
         * // -> 2025-01-12
         * $date->month = 15; // Set month to 15
         * // -> 2026-03-12
         * $date->month--;    // Decrement month
         * // -> 2026-02-12
         * $date->month++;    // Increment month
         * // -> 2026-03-12
         * $date->month -= 4; // Subtract 4 months
         * // -> 2025-11-12
         * $date->month += 5; // Add 5 months
         * // -> 2026-04-12
         *
         * // Assign zero or negative
         * $date = new DateTime(); // Current date: 12 April 2025.
         * // -> 2025-04-12
         *
         * $date->month = 0;  // Set month to zero
         * // -> 2024-12-12
         * // [!!!] Not a 1st January because result (2025-00-12) will be transformed
         *
         * $date->month = -1; // Set month to -1
         * // -> 2023-11-12
         * // [!!!] Not a December, because 0 - last month of previous year.
         *
         * // Increase/Decrease with last days
         * $date = new DateTime(); // Current date: 31 March 2025.
         * // -> 2025-03-31
         *
         * $date->month--;    // Decrement month
         * // -> 2025-03-03
         * // [!!!] Not a February because result (2025-02-31) will be transformed.
         * ```
         *
         * @param int $months Number of months.
         *
         * @return void
         */
        set (int $months) {
            $current = (int)$this->format('m');

            switch (true) {
                case $months > $current:
                    $this->addMonths($months - $current);
                    break;
                case $months < $current:
                    $this->subMonths($current - $months);
                    break;
            }
        }
    }

    /**
     * Number of days.
     * @var int
     * @virtual
     */
    public int $day {
        /**
         * Returns the number of days relative to the current date and time object.
         * @return int
         */
        get => (int)$this->format('d');
        /**
         * Sets the number of days into the current date and time object.
         *
         * __ATTENTION!__
         *
         * A day cannot be equal to zero. Therefore, all manipulations with assigning a value of 0 mean moving to the
         * previous day, and assigning negative values increases by 1.
         *
         * Example:
         * ```
         * $date = new DateTime(); // Current date: 12 April 2025.
         * // -> 2025-04-12
         *
         * $date->day = 1;  // Set day to 1
         * // -> 2025-04-01
         * $date->day = 50; // Set day to 50
         * // -> 2025-05-20
         * $date->day--;    // Decrement day
         * // -> 2025-05-19
         * $date->day++;    // Increment day
         * // -> 2025-05-20
         * $date->day -= 4; // Subtract 4 days
         * // -> 2025-05-16
         * $date->day += 5; // Add 5 days
         * // -> 2025-05-21
         *
         * // Assign zero or negative
         * $date = new DateTime(); // Current date: 12 April 2025.
         * // -> 2025-04-12
         *
         * $date->day = 0;  // Set day to zero
         * // -> 2025-03-31
         * // [!!!] Not a 1st April because result (2025-04-00) will be transformed
         *
         * $date->day = -1; // Set day to -1
         * // -> 2025-02-27
         * // [!!!] Not a last February day, because 0 = last day
         * ```
         *
         * @param int $days Number of days.
         *
         * @return void
         */
        set (int $days) {
            $current = (int)$this->format('d');

            switch (true) {
                case $days > $current:
                    $this->addDays($days - $current);
                    break;
                case $days < $current:
                    $this->subDays($current - $days);
                    break;
            }
        }
    }

    /**
     * Number of hours.
     * @var int
     * @virtual
     */
    public int $hour {
        /**
         * Returns the number of days relative to the current date and time object.
         * @return int
         */
        get => (int)$this->format('H');
        /**
         * Sets the number of hours into the current date and time object.
         *
         * @param int<0,max> $hours Number of hours.
         *
         * @return void
         */
        set (int $hours) {
            $current = (int)$this->format('H');

            switch (true) {
                case $hours > $current:
                    $this->addHours($hours - $current);
                    break;
                case $hours < $current:
                    $this->subHours($current - $hours);
                    break;
            }
        }
    }

    /**
     * Number of minutes.
     * @var int
     * @virtual
     */
    public int $minute {
        /**
         * Returns the number of minutes relative to the current date and time object.
         * @return int
         */
        get => (int)$this->format('i');
        /**
         * Sets the number of minutes into the current date and time object.
         *
         * @param int $minutes Number of minutes.
         *
         * @return void
         */
        set (int $minutes) {
            $current = (int)$this->format('i');

            switch (true) {
                case $minutes > $current:
                    $this->addMinutes($minutes - $current);
                    break;
                case $minutes < $current:
                    $this->subMinutes($current - $minutes);
                    break;
            }
        }
    }

    /**
     * Number of seconds.
     * @var int
     * @virtual
     */
    public int $second {
        /**
         * Returns the number of seconds relative to the current date and time object.
         * @return int
         */
        get => (int)$this->format('s');

        /**
         * Sets the number of seconds into the current date and time object.
         *
         * @param int{1:} $seconds Number of seconds.
         *
         * @return void
         */
        set (int $seconds) {
            $current = (int)$this->format('s');

            switch (true) {
                case $seconds > $current:
                    $this->addSeconds($seconds - $current);
                    break;
                case $seconds < $current:
                    $this->subSeconds($current - $seconds);
                    break;
            }
        }
    }

    /**
     * Number of microseconds.
     * @var int
     * @virtual
     */
    public int $microsecond {
        /**
         * Returns the number of microseconds relative to the current date and time object.
         * @return int
         */
        get => (int)$this->format('u');
        /**
         * Sets the number of microseconds into the current date and time object.
         *
         * @param int{1:} $microseconds Number of microseconds.
         *
         * @return void
         */
        set (int $microseconds) {
            $current = (int)$this->format('u');

            switch (true) {
                case $microseconds > $current:
                    $this->addMicroseconds($microseconds - $current);
                    break;
                case $microseconds < $current:
                    $this->subMicroseconds($current - $microseconds);
                    break;
            }
        }
    }

    /**
     * Number of weekdays.
     * @var int
     * @virtual
     */
    public int $weekday {
        /**
         * Returns the weekday number relative to the current date and time object.
         * @return int<1,53>
         */
        get => (int)$this->format('w');
    }

    /**
     * Number of quarters.
     * @var int
     * @virtual
     */
    public int $quarter {
        /**
         * Returns the number of quarters relative to the current date and time object.
         * @return int<1,4>
         */
        get => (int)ceil($this->month / 3);
    }

    /**
     * Half-year number.
     * @var int
     * @virtual
     */
    public int $half {
        /**
         * Returns the number of half-year relative to the current date and time object.
         * @return int<1,2>
         */
        get => (int)ceil($this->month / 6);
    }

    /**
     * Last day of the month.
     * @var int
     */
    public int $lastDay {
        /**
         * Returns the number of the last day of the month relative to the current date and time object.
         *
         * @return int<28,31>
         */
        get => (int)$this->format('t');
    }

    /**
     * Representation of date and time constructor.
     *
     * If argument <code>timezone</code> is omitted, the UTC timezone will be used.
     *
     * __Note:__
     *
     * The argument <code>timezone</code> are ignored when the argument <code>datetime</code> either is a UNIX
     * timestamp (e.g. @946684800) or specifies a timezone (e.g. 2010-01-28T15:00:00+02:00).
     *
     * @param string       $datetime [optional]
     * @param DateTimeZone $timezone [optional] A <code>DateTimeZone</code> object representing the timezone of date
     *                               and time.
     * @param string       $format   [optional] Format for representing date and time as a string value. By default,
     *                               {@see DATE_RFC3339_EXTENDED}.
     *
     * @throws DateMalformedStringException Emits Exception in case of an error.
     */
    public function __construct(
        string $datetime = 'now',
        DateTimeZone $timezone = new DateTimeZone('UTC'),
        public string $format = DATE_RFC3339_EXTENDED,
    )
    {
        parent::__construct($datetime, $timezone);
    }

    /**
     * Returns date and time represented as string.
     *
     * Date and time formatting can be specified in the {@see DateTime::$format} property.
     *
     * @return string String representation of the date and time.
     */
    public function __toString(): string
    {
        return $this->format($this->format);
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     */
    public function add(DateInterval $interval): static
    {
        if (!$interval instanceof TimeOffsetInterface || !$interval->byCalendar || $interval->isInfinity) {
            return parent::add($interval);
        }

        $originTimezone = $this->getTimezone();
        $this->setTimezone($interval->timeZone);
        parent::add($interval);

        switch ($interval->intervalType) {
            case TimeOffsetFactor::Second:
                $this->microsecond = 0;
                break;
            case TimeOffsetFactor::Minute:
                $this->setTime($this->hour, $this->minute);
                break;
            case TimeOffsetFactor::Hour:
                $this->setTime($this->hour, 0);
                break;

            case TimeOffsetFactor::Week:
                $this->setTime(0, 0);
                $this->day -= $this->weekday === 0 ? 6 : $this->weekday - 1;
                break;
            case TimeOffsetFactor::Month:
                $this->setTime(0, 0);
                $this->day = 1;
                break;
            case TimeOffsetFactor::Quarter:
                $this->setTime(0, 0);
                $this->setDate($this->year, $this->quarter * 3 - 2, 1);
                break;
            case TimeOffsetFactor::Year:
                $this->setTime(0, 0);
                $this->setDate($this->year, 1, 1);
                break;
            default:
                $this->setTime(0, 0);
                break;
        }

        $this->setTimezone($originTimezone);
        return $this;
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function addDays(int $days): static
    {
        return $days < 0 ? $this->subDays(abs($days)) : $this->add(new DateInterval('P' . $days . 'D'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function addHours(int $hours): static
    {
        return $hours < 0 ? $this->subHours(abs($hours)) : $this->add(new DateInterval('PT' . $hours . 'H'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function addMicroseconds(int $microseconds): static
    {
        if ($microseconds < 0) {
            return $this->subMicroseconds(abs($microseconds));
        }

        $real = $this->microsecond + $microseconds;

        if ($real < 1000000) {
            return $this->setMicrosecond($real);
        }

        $seconds = (int)floor($real / 1000000);
        $real %= 1000000;
        $this->addSeconds($seconds);
        return $this->setMicrosecond($real);
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function addMinutes(int $minutes): static
    {
        return $minutes < 0 ? $this->subMinutes(abs($minutes)) : $this->add(new DateInterval('PT' . $minutes . 'M'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function addMonths(int $months): static
    {
        return $months < 0 ? $this->subMonths(abs($months)) : $this->add(new DateInterval('P' . $months . 'M'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function addSeconds(int $seconds): static
    {
        return $seconds < 0
            ? $this->subSeconds(abs($seconds))
            : $this->add(new DateInterval('PT' . $seconds . 'S'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function addYears(int $years): static
    {
        return $years < 0 ? $this->subYears(abs($years)) : $this->add(new DateInterval('P' . $years . 'Y'));
    }

    /**
     * Returns the difference between two DateTime objects
     *
     * @param \DateTimeInterface $targetObject The date to compare to.
     * @param bool              $absolute     Should the interval be forced to be positive?
     *
     * @return DateDuration The object representing the difference between the two dates.
     * @throws DateMalformedIntervalStringException
     */
    public function diff(\DateTimeInterface $targetObject, bool $absolute = false): DateDuration
    {
        return DateDuration::createFromDateInterval(parent::diff($targetObject, $absolute));
    }

    /**
     * Returns the specify data which should be serialized to JSON.
     * @return mixed data which can be serialized by JSON Coders.
     */
    public function jsonSerialize(): string
    {
        return $this->__toString();
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     */
    public function setMicrosecond(int $microsecond): static
    {
        return parent::setMicrosecond($microsecond);
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     * @throws DateInvalidOperationException
     */
    public function sub(DateInterval $interval): static
    {
        if (!$interval instanceof TimeOffsetInterface || !$interval->byCalendar || $interval->isInfinity) {
            return parent::sub($interval);
        }

        $originTimezone = $this->getTimezone();
        $this->setTimezone($interval->timeZone);
        parent::sub($interval);

        switch ($interval->intervalType) {
            case TimeOffsetFactor::Second:
                $this->setTime($this->hour, $this->minute, $this->second + 1);
                break;
            case TimeOffsetFactor::Minute:
                $this->setTime($this->hour, $this->minute + 1);
                break;
            case TimeOffsetFactor::Hour:
                $this->setTime($this->hour + 1, 0);
                break;
            case TimeOffsetFactor::Week:
                $this->setTime(0, 0);
                $this->day += 8 - ($this->weekday === 0 ? 6 : $this->weekday);
                break;
            case TimeOffsetFactor::Month:
                $this->setTime(0, 0);
                $this->setDate($this->year, $this->month + 1, 1);
                break;
            case TimeOffsetFactor::Quarter:
                $this->setTime(0, 0);
                $this->setDate($this->year, $this->quarter * 3 + 1, 1);
                break;
            case TimeOffsetFactor::Year:
                $this->setTime(0, 0);
                $this->setDate($this->year + 1, 1, 1);
                break;
            default:
                $this->setTime(0, 0);
                $this->day++;
                break;
        }

        $this->setTimezone($originTimezone);
        return $this;
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function subDays(int $days): static
    {
        return $days < 0 ? $this->addDays(abs($days)) : $this->sub(new DateInterval('P' . $days . 'D'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function subHours(int $hours): static
    {
        return $hours < 0 ? $this->addHours(abs($hours)) : $this->sub(new DateInterval('PT' . $hours . 'H'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function subMicroseconds(int $microseconds): static
    {
        if ($microseconds < 0) {
            return $this->addMicroseconds(abs($microseconds));
        }

        $real = $this->microsecond - $microseconds;

        if ($real >= 0) {
            return $this->setMicrosecond($real);
        }

        $real = abs($real) + 1000000;

        $seconds = (int)floor($real / 1000000);
        $real %= 1000000;
        $this->subSeconds($seconds);

        return $real > 0 ? $this->setMicrosecond(1000000 - $real) : $this->setMicrosecond(0);
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function subMinutes(int $minutes): static
    {
        return $minutes < 0 ? $this->addMinutes(abs($minutes)) : $this->sub(new DateInterval('PT' . $minutes . 'M'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function subMonths(int $months): static
    {
        return $months < 0 ? $this->addMonths(abs($months)) : $this->sub(new DateInterval('P' . $months . 'M'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function subSeconds(int $seconds): static
    {
        return $seconds < 0 ? $this->addSeconds(abs($seconds)) : $this->sub(new DateInterval('PT' . $seconds . 'S'));
    }

    /**
     * @inheritDoc
     *
     * @return static Current object, for chaining.
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function subYears(int $years): static
    {
        return $years < 0 ? $this->addYears(abs($years)) : $this->sub(new DateInterval('P' . $years . 'Y'));
    }
}
