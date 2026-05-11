<?php

declare(strict_types = 1);

namespace KVEugene\DateTime;

use DateInterval;
use DateInvalidOperationException;
use DateInvalidTimeZoneException;
use DateMalformedIntervalStringException;
use DateTimeZone;
use JsonSerializable;
use Stringable;
use KVEugene\DateTime\Enums\TimeOffsetFactor;
use KVEugene\DateTime\Interfaces\DateTimeInterface;
use KVEugene\DateTime\Interfaces\TimeOffsetInterface;

/**
 * Time offset class.
 *
 * @immutable
 */
class TimeOffset extends DateDuration implements TimeOffsetInterface, JsonSerializable
{
    /**
     * Pattern for source string matches.
     *
     * @var string
     */
    private const string PARSE_MASK = '/^(\d+)([smhdwnqy])([+-]\d{4}| [A-Za-z\/]+)?$/i';

    final public const string INFINITY = 'Infinity';

    // region Properties

    /**
     * Total number of seconds the interval spans.
     *
     * @var int
     * @virtual
     */
    public int $seconds {
        /**
         * Returns the number of seconds in the datetime interval.
         *
         * @return int
         */
        get {
            // Sliding mode
            if (!$this->byCalendar) {
                return (((($this->y * 12 + $this->m) * 30 + $this->d) * 24 + $this->h) * 60 + $this->i) * 60
                    + $this->s;
            }

            // Calendar mode
            $currentDate = new DateTime();

            return $currentDate->getTimestamp() - $this->getDateFrom($currentDate)->getTimestamp();
        }
    }

    /**
     * Indicator that the offset is in calendar mode.
     *
     * @var bool {@see true TRUE} if the offset is in the calendar mode, {@see false FALSE} if the offset is in the sliding mode.
     * @virtual
     */
    public bool $byCalendar {
        /**
         * Returns an indicator that the offset is in calendar mode.
         * @return bool {@see true TRUE} if the offset is in the calendar mode, {@see false FALSE} if the offset is in the sliding mode.
         */
        get => $this->timeZone !== null;
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
         *
         * @return bool {@see true TRUE} if the offset is infinity, or {@see false FALSE} otherwise.
         */
        get => $this->y === 0 && $this->m === 0 && $this->d === 0 && $this->h === 0 && $this->i === 0 && $this->s === 0;
    }

    /**
     * Time offset type.
     *
     * @var TimeOffsetFactor
     */
    public TimeOffsetFactor $intervalType {
        /**
         * Returns the time offset type.
         *
         * @return TimeOffsetFactor
         */
        get {
            if (!isset($this->intervalType)) {
                $this->intervalType = TimeOffsetFactor::Second;
            }

            return $this->intervalType;
        }
    }

    /**
     * Specified time zone.
     *
     * @var DateTimeZone|null Object for a calendar mode of the offset or {@see null NULL} for a sliding mode.
     */
    public ?DateTimeZone $timeZone {
        /**
         * Returns the specified time zone for a calendar mode of the offset.
         * @return DateTimeZone|null
         */
        get {
            if (!isset($this->timeZone)) {
                $this->timeZone = null;
            }

            return $this->timeZone;
        }
    }

    /**
     * Default time zone for correct calculation of the offset result.
     *
     * @var DateTimeZone Object for internal transformation of the time interval.
     */
    private DateTimeZone $defaultDTZ {
        /**
         * Returns the default time zone for correct calculation of the offset result.
         * @return DateTimeZone
         */
        get {
            if (!isset($this->defaultDTZ)) {
                $this->defaultDTZ = new DateTimeZone('UTC');
            }

            return $this->defaultDTZ;
        }
    }

    // endregion

    /**
     * TimeOffset constructor.
     *
     * If the initial value contains a time zone, the offset is calculated using the calendar mode. Unlike the sliding
     * mode, the calendar mode calculates the offset by the beginning of a specific day, so it does not make sense when
     * specifying an interval in hours, minutes or seconds.
     *
     * For example, if calculates the offset by the one weeks on sliding mode, the result be current date subs one week.
     * In calendar mode the results offset be to first day of previous week.
     *
     * Time offset initial value __MUST__ be in format:
     * ```
     * <interval> <type> [ <timezone> ]
     * ```
     *
     * Offset size:
     * ```
     * <interval> = int
     * ```
     *
     * Type of the interval:
     * ```
     * <type> = <seconds>|<minutes>|<hours>|<days>|<weeks>|<months>|<quarters>|<years>
     *
     * <seconds> = "s"
     * <minutes> = "m"
     * <hours> = "h"
     * <days> = "d"
     * <weeks> = "w"
     * <months> = "n"
     * <quarters> = "q"
     * <years> = "y"
     * ```
     *
     * Timezone:
     * ```
     * <timezone> = <digital_tz>|<string_tz>
     *
     * <digital_tz> = "+"|"-" <hour_tz> <minute_tz>
     * <hour_tz> = <digit> <digit>
     * <minute_tz> = <digit> <digit>
     * <digit> = 0-9
     *
     * <string_tz> = <space> <name_tz>
     * <space> = " "
     * <name_tz> = One of the timezone name by RFC.
     * ```
     *
     * @param string $source Initial time offset value.
     *
     * @throws DateMalformedIntervalStringException
     * @throws DateInvalidTimeZoneException
     */
    public function __construct(
        public readonly string $source,
    )
    {
        parent::__construct($this->init());
    }

    /**
     * Initializes time offset.
     *
     * @return string The duration value to initialize the parent DateInterval structure.
     * @throws DateInvalidTimeZoneException
     * @see TimeOffset::$intervalType Offset type
     * @see TimeOffset::$timeZone Time zone to offset.
     */
    private function init(): string
    {
        if (!preg_match(self::PARSE_MASK, $this->source, $m)) {
            return 'PT0S';
        }

        $this->intervalType = TimeOffsetFactor::fromSource(isset($m[2]) ? mb_strtolower($m[2]) : 's');
        $this->timeZone = isset($m[3]) ? new DateTimeZone(trim($m[3])) : null;

        return $this->intervalType->format(isset($m[1]) ? (int)$m[1] : 0);
    }

    /**
     * @inheritDoc
     * @return string Returns the Time Offset as string value.
     */
    public function __toString(): string
    {
        if ($this->isInfinity) {
            return self::INFINITY;
        }

        $sec = $this->seconds;
        $date = '';
        $time = '';

        if ($sec > 604800) {
            $date .= (int) floor($sec / 604800) . 'W';
            $sec %= 604800;
        }
        if ($sec > 86400) {
            $date .= (int) floor($sec / 86400) . 'D';
            $sec %= 86400;
        }
        if ($sec > 3600) {
            $time .= (int) floor($sec / 3600) . 'H';
            $sec %= 3600;
        }
        if ($sec > 60) {
            $time .= (int) floor($sec / 60) . 'M';
            $sec %= 60;
        }
        if ($sec > 0) {
            $time .= $sec . 'S';
        }

        return 'P' . $date . ($time !== '' ? 'T' . $time : '');
    }

    /**
     * Converts a date to the start date of the interval and returns the result.
     *
     * @param \DateTimeInterface $dateTime Initial date
     *
     * @return \DateTimeInterface Converted date
     * @throws DateInvalidOperationException
     * @throws DateMalformedIntervalStringException
     */
    public function getDateFrom(\DateTimeInterface $dateTime): \DateTimeInterface
    {
        // Sliding mode
        if (!$this->byCalendar) {
            return $dateTime->sub($this);
        }

        // Calendar mode start.
        // If is infinity - do nothing.
        if ($this->isInfinity) {
            return $dateTime;
        }

        if ($dateTime instanceof DateTimeInterface) {
            return $dateTime->sub($this);
        }

        // Sub interval and reset time.
        $dateTime->setTimezone($this->timeZone)->sub($this)->setTime(0, 0);

        // Jumps to the first day of the interval, then adds the full interval since "1" is always "for now".
        $result = match ($this->intervalType) {
            TimeOffsetFactor::Week    => $dateTime->add(
                new DateInterval(
                    'P' . 7 - ((int)$dateTime->format('w') === 0 ? 6 : (int)$dateTime->format('w') - 1) . 'D'
                )
            ),
            TimeOffsetFactor::Month   => $dateTime->setDate(
                (int)$dateTime->format('Y'),
                (int)$dateTime->format('m') + 1,
                1
            ),
            TimeOffsetFactor::Quarter => $dateTime->setDate(
                (int)$dateTime->format('Y'),
                (int)ceil((int)$dateTime->format('m') / 3) * 3 + 1,
                1
            ),
            TimeOffsetFactor::Year    => $dateTime->setDate((int)$dateTime->format('Y') + 1, 1, 1),
            default                   => $dateTime->add(new DateInterval('P1D')),
        };

        // Finally, sets the UTC time zone.
        return $result->setTimezone($this->defaultDTZ);
        // Calendar window end.
    }

    /**
     * Returns the object data that should be serialized to JSON.
     * @return mixed Data which can be serialized by JSON Coder.
     */
    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}
