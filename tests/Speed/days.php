<?php

include __DIR__ . '/../../vendor/autoload.php';

use function KVEugene\DateTime\Tests\Speed\test;
use function KVEugene\DateTime\Tests\Speed\stats;

$results = [];
$cycles = 1000000;

$date = new DateTime();
$results[] = test('PHP DateTime: add day by interval', $cycles, static fn(DateTime $date) => $date->add(new DateInterval('P1D')), [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: add day by interval', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->add(new DateInterval('P1D')), [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: addDays function', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->addDays(1), [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: post increment day', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->day++, [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: pre increment day', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => ++$date->day, [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: add days', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->day += 2, [$date]);

$date = new DateTime();
$results[] = test('PHP DateTime: set random days', $cycles, static fn(DateTime $date) => $date->setDate((int)$date->format('Y'), (int)$date->format('n'), random_int(5, 25)), [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: set random days', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->day = random_int(5, 25), [$date]);

stats($results);