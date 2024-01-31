<?php

require_once 'Stack.php';
require_once 'Queue.php';

echo 'Stack ======================' . PHP_EOL;
$stack = new Stack;

$stack->add('item 1');
$stack->add(2);
$stack->add('item 3');

echo 'Stack count - ' . $stack->count();

echo $stack->get();
echo $stack->get();
echo $stack->get();
echo $stack->get();
echo 'Stack ======================' . PHP_EOL;

 echo 'Queue ======================' . PHP_EOL;

 $queue = new Queue;
 $queue->add('item 1');
 $queue->add('item 2');
 $queue->add('item 3');

echo 'Queue count - ' . $queue->count();

 echo $queue->get();
 echo $queue->get();
 echo $queue->get();
 echo $queue->get();

 echo 'Queue ======================' . PHP_EOL;