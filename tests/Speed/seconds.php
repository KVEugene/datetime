<?php

include __DIR__ . '/../../vendor/autoload.php';

use function KVEugene\DateTime\Tests\Speed\test;
use function KVEugene\DateTime\Tests\Speed\stats;

$results = [];
$cycles = 1000000;

$date = new DateTime();
$results[] = test('PHP DateTime: add second by interval', $cycles, static fn(DateTime $date) => $date->add(new DateInterval('PT1S')), [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: add second by interval', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->add(new DateInterval('PT1S')), [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: addSeconds function', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->addSeconds(1), [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: Post Increment seconds', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->second++, [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: Pre Increment seconds', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => ++$date->second, [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: Add seconds', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->second += 20, [$date]);

$date = new DateTime();
$results[] = test('PHP DateTime: Set random seconds', $cycles, static fn(DateTime $date) => $date->setTime((int) $date->format('G'), (int) $date->format('i'), random_int(10, 6000)), [$date]);

$date = new \KVEugene\DateTime\DateTime();
$results[] = test('Custom DateTime: Set random seconds', $cycles, static fn(\KVEugene\DateTime\DateTime $date) => $date->second = random_int(10, 6000), [$date]);

stats($results);
