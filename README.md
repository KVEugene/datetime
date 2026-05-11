# datetime
PHP DateTime Extension

### Requirements
This library works with PHP version 8.4 and higher.

### Installation
You may install library with Composer:

```php

```

### Using
Syntactic Sugar for Date and Time.

```php
use KVEugene\DateTime\DateTime;

// Get the hour from the DateTime object (natively).
$date = new \DateTime();
$hour = (int) $date->format('H');

// Get the hour from the DateTime object from library.
$date = new DateTime();
$hour = $date->hour;

// Set the current date to the first day of the month (natively).
$date = new \DateTime();
$date->setDate((int) $date->format('Y'), (int) $date->format('n'), 1);

// Set the current date to the first day of the month using a library.
$date = new DateTime();
$date->day = 1;
```

TimeOffset as a extended DateInterval.
```php
use KVEugene\DateTime\DateTime;
use KVEugene\DateTime\TimeOffset;

// Get the start date and time of the current quarter in the Europe/Riga time zone.
$date = new DateTime()->sub(new TimeOffset('1q Europe/Riga'));

// Get the start date and time of the previous quarter in the Europe/Riga time zone.
$date = new DateTime()->sub(new TimeOffset('2q Europe/Riga'));
```
