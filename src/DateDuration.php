<?php

declare(strict_types=1);

namespace KVEugene\DateTime;

use DateInterval;
use DateMalformedIntervalStringException;
use Stringable;
use KVEugene\DateTime\Interfaces\DateIntervalInterface;

/**
 *
 */
class DateDuration extends DateInterval implements DateIntervalInterface, Stringable
{
    /**
     * @throws DateMalformedIntervalStringException
     */
    public static function createFromDateInterval(DateInterval $interval): static
    {
        return new static($interval->format(self::FORMAT));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $date = '';
        $time = '';

        if ($this->y > 0 ) {
            $date .= '%yY';
        }
        if ($this->m > 0 ) {
            $date .= '%mM';
        }
        if ($this->d > 0 ) {
            $date .= '%dD';
        }
        if ($this->h > 0 ) {
            $time .= '%hH';
        }
        if ($this->i > 0 ) {
            $time .= '%iM';
        }
        if ($this->s > 0 ) {
            $time .= '%sS';
        }

        return $this->format('P' . $date . ($time !== '' ? 'T' . $time : ''));
    }
}
