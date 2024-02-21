<?php
require_once 'class/Gun.php';
class Hero
{
    protected int $health;
    protected int $armor;
    protected Gun $gun;
    public function __construct(int $health, int $armor, Gun $gun)
    {
        $this->health = $health;
        $this->armor = $armor;
        $this->gun = $gun;
    }

    public function getArmor(): int
    {
        return $this->armor;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getDamage()
    {
        return $this->gun->criticalDamage();
    }

    public function takeDamage(int $damage): void
    {
        $this->health -= max(0, $damage);
    }
}

class Warrior extends Hero
{

}

class Magician extends Hero
{

}

class Archer extends Hero
{

}