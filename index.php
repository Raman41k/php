<?php

class Animal
{
    function greeting()
    {
        echo 'Hello I am an animal' . PHP_EOL;
    }
}

class Lion extends Animal
{
    function paws()
    {
        echo 'I am a lion and I am walking on 4 paws' . PHP_EOL;
    }
}

class Elephant extends Animal
{
    function big()
    {
        echo 'I am an elephant and I\'m the biggest animal' . PHP_EOL;
    }
}

class Monkey extends Animal
{
    function banana()
    {
        echo 'I am a monkey and I like bananas' . PHP_EOL;
    }
}

class Shark extends Animal
{
    function dangerous()
    {
        echo 'I am a shark and I am very dangerous animal in the sea' . PHP_EOL;
    }
}

$lion = new Lion;
$lion->paws();
$lion->greeting();
echo '------------' . PHP_EOL;
$elephant = new Elephant;
$elephant->big();
$elephant->greeting();
echo '------------' . PHP_EOL;
$monkey = new Monkey;
$monkey->banana();
$monkey->greeting();
echo '------------' . PHP_EOL;
$shark = new Shark;
$shark->dangerous();
$shark->greeting();
