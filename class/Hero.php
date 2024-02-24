<?php
require_once 'class/Gun.php';
class Hero
{
    protected int $health;
    protected int $armor;
    protected Gun $gun;

    public function __construct(int $health, int $armor)
    {
        $this->health = $health;
        $this->armor = $armor;
    }

    public function getArmor(): int
    {
        return $this->armor;
    }

    public function setGun(Gun $gun): void
    {
        $this->gun = $gun;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getDamage(): int
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
    private array $winWords = ['Warrior win!'];
    private array $loseWords = ['Warrior lose!', 'Warrior is a looser'];
    public function sayOnLose(): string
    {
        $randomIndex = array_rand($this->loseWords);
        return $this->loseWords[$randomIndex];
    }

    public function sayOnWin(): string
    {
        $randomIndex = array_rand($this->winWords);
        return $this->winWords[$randomIndex];
    }
}

class Magician extends Hero
{
    private array $winWords = ['Magician win!'];
    private array $loseWords = ['Magician lose!', 'Magician is a looser'];
    public function sayOnLose(): string
    {
        $randomIndex = array_rand($this->loseWords);
        return $this->loseWords[$randomIndex];
    }

    public function sayOnWin(): string
    {
        $randomIndex = array_rand($this->winWords);
        return $this->winWords[$randomIndex];
    }
}

class Archer extends Hero
{
    private array $winWords = ['Archer win!'];
    private array $loseWords = ['Archer lose!', 'Archer is a looser'];
    public function sayOnLose(): string
    {
        $randomIndex = array_rand($this->loseWords);
        return $this->loseWords[$randomIndex];
    }

    public function sayOnWin(): string
    {
        $randomIndex = array_rand($this->winWords);
        return $this->winWords[$randomIndex];
    }
}