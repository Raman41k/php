<?php
require_once 'class/Gun.php';
require_once 'class/Hero.php';
class HeroFactory
{
    public static function createWarrior(int $damage, int $health, int $armor): Hero
    {
        $weapon = new Sword($damage);
        $hero = new Hero($health, $armor);
        $hero->setGun($weapon);
        return $hero;
    }

    public static function createArcher(int $damage, int $health, int $armor): Hero
    {
        $weapon = new Bow($damage);
        $hero = new Hero($health, $armor);
        $hero->setGun($weapon);
        return $hero;
    }

}