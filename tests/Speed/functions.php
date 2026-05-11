<?php

namespace KVEugene\DateTime\Tests\Speed;

/**
 * Speed test function.
 *
 * @param string $name Test name
 * @param int $cycles Count of cycling
 * @param callable $function Testing function
 * @param array $args Arguments for testing function
 * @return array{name: string, counts: int, time: float, memory_peak: float, memory_usage: float} Test results
 */
function test(string $name, int $cycles, callable $function, array $args): array
{
    echo 'Running test "', $name, '"...';

    $micro = microtime(true);
    for ($i = 0; $i < $cycles; $i++) {
        $function(...$args);
    }
    $end = microtime(true) - $micro;

    echo "\033[2K\033[120D";

    return [
        'name' => $name,
        'counts' => $cycles,
        'time' => $end,
        'memory_peak' => memory_get_peak_usage(true) / 1024 / 1024,
        'memory_usage' => memory_get_usage(true) / 1024 / 1024,
    ];
}

/**
 * Display test results.
 * @param array<int, array{name: string, counts: int, time: float, memory_peak: float, memory_usage: float}> $results
 * @return void
 */
function stats(array $results): void
{
    echo sprintf("%-40s\t%-10s\t%-10s\t%-15s\t%-15s\n", 'Test name', 'Cycles', 'Time', 'Memory Peak', 'Memory Usage');
    foreach ($results as $result) {
        echo sprintf(
            "%40s\t%10d\t%10f\t%12.2f Mb\t%12.2f Mb\n",
            $result['name'],
            $result['counts'],
            $result['time'],
            $result['memory_peak'],
            $result['memory_usage']
        );
    }
}
