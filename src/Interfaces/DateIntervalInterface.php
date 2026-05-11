<?php

declare(strict_types=1);

namespace KVEugene\DateTime\Interfaces;

use DateMalformedIntervalStringException;

/**
 * Date interval interface.
 */
interface DateIntervalInterface
{
    /**
     * The default format for converting an internal PHP DateInterval object into custom objects implementing
     * the current interface.
     * @link https://php.net/manual/en/dateinterval.format.php
     */
    public const string FORMAT = 'P%yY%mM%dDT%hH%iM%sS';

    /**
     * Formats the interval.
     *
     * @param string $format
     * @return string The formatted interval.
     * @link https://php.net/manual/en/dateinterval.format.php
     */
    public function format(string $format): string;

    /**
     * Sets up a DateInterval from the relative parts of the string
     *
     * @param string $datetime
     *
     * @return static|false Returns a new {@link https://www.php.net/manual/en/class.dateinterval.php DateInterval}
     * instance on success, or {@see false FALSE} on failure.
     * @link https://php.net/manual/en/dateinterval.createfromdatestring.php
     * @noinspection PhpMissingReturnTypeInspection In PHP 8.4 DateInterval has not a return type declaration
     * @throws DateMalformedIntervalStringException
     */
    public static function createFromDateString(string $datetime);
}
