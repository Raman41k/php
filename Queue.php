<?php
class Queue
{
    private $queue;

    public function __construct(){
        $this->queue = [];
    }

    public function get()
    {
        if (end($this->queue)){
            return array_shift($this->queue) . PHP_EOL;
        } else{
            echo ("Queue is empty") . PHP_EOL;
        }
    }

    public function add($item): void
    {
        $this->queue[] = $item;
    }

    public function count()
    {
        return count($this->queue) . PHP_EOL;
    }

    public function clear()
    {
        return $this->queue = null;
    }
}