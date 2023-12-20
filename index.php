<?php
function fibonacci(int $amount)
{
    $fibonacci = [0, 1];
    if ($amount <= 2) return $fibonacci;

    for ($i = 2; $i < $amount; $i++) {
        $fibonacci[$i] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
    }

    return $fibonacci;
}

echo '<pre>';
print_r(fibonacci(10));
echo '</pre>' . PHP_EOL;
$sum_of_fibonacci = array_sum(fibonacci(10));
echo 'Sum of numbers fibonacci ' . $sum_of_fibonacci;