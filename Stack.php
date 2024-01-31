<?php
class Stack
{
    private $data;

    public function __construct(){
        $this->data = [];
    }

    public function get()
    {
        if (end($this->data)){
            return array_pop($this->data) . PHP_EOL;
        } else{
            echo ("Stack is empty") . PHP_EOL;
        }
    }

    public function add($item): void
    {
        $this->data[] = match (gettype($item)) {
            "integer", "string" => $item,
            default => throw new Exception('Uncorrect data type'),
        };
    }

    public function count(){
        return count($this->data) . PHP_EOL;
    }

    public function clear(){
        return $this->data = null;
    }
}