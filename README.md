# PHP DateTime and DateInterval Extension

[![PHPUnit Tests](https://github.com/KVEugene/datetime/actions/workflows/phpunit.yml/badge.svg?branch=master)](https://github.com/KVEugene/datetime/actions/workflows/phpunit.yml)
[![Coverage](https://raw.githubusercontent.com/KVEugene/datetime/image-data/coverage.svg)](https://github.com/KVEugene/datetime/blob/image-data/coverage.svg)
![License: MIT](https://shields.io/badge/License-MIT-white)
![Language: PHP](https://shields.io/badge/Language-PHP-blue)
![Version: >=8.4](https://shields.io/badge/Version->=8.4-blue)

## Information
This solution is designed to simplify the definition of time range boundaries in both sliding and calendar window modes.

The sliding window mode involves deriving the start and end of a time range relative to the current date and time, specified in seconds, minutes, hours, days, weeks, months, quarters, or years. This mode is implemented using the standard `DateInterval` mechanism.

The calendar window mode involves defining the start and end points of a specific time range relative to the calendar. In other words, a calendar window allows you to determine the beginning and end of the current, previous, or next day, week, month, quarter, etc.

The operating mode is determined based on whether a time zone is specified. Specifically, if a time zone is designated for a given interval, values ​​are calculated according to the calendar; otherwise, calculations are performed based on a sliding time window.

## Requirements
This library works only with PHP version 8.4 and higher.

Extension mb-string is required.

## Installation
You can install the library using Composer:

```php
composer install kveugene/datetime
```

## Usage
### DateTime
Syntactic Sugar for Date and Time.

```php
use KVEugene\DateTime\DateTime;

// Extracts the hour from a natively DateTime object.
$date = new \DateTime();
$hour = (int) $date->format('H');

// Extracts the hour from a library DateTime object.
$date = new DateTime();
$hour = $date->hour;

// Sets the date to the first day of the month (natively)
$date = new \DateTime();
$date->setDate((int) $date->format('Y'), (int) $date->format('n'), 1);

// Sets the date to the first day of the month using a library.
$date = new DateTime();
$date->day = 1;
```

### TimeOffset
The TimeOffset object is an extension of the native DateInterval object, enabling the use of calendar-based date and time definitions.

```php
use KVEugene\DateTime\DateTime;
use KVEugene\DateTime\TimeOffset;

// Get the start date and time of the quarter: sliding mode.
$date = new DateTime()->sub(new TimeOffset('1q'));

// Get the start date and time of the current quarter in the Europe/Riga time zone.
$date = new DateTime()->sub(new TimeOffset('1q Europe/Riga'));

// Get the start date and time of the previous quarter in the Europe/Riga time zone.
$date = new DateTime()->sub(new TimeOffset('2q Europe/Riga'));
```

You can obtain additional information about available properties and formats from the source code documentation.