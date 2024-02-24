<?php
class Gun
{
    protected int $damage;
    private int $specialDamage = 10;

    public function __construct(int $damage)
    {
        $this->damage = $damage;
    }

    public function criticalDamage():int
    {
        return $this->damage + ($this->damage * $this->specialDamage / 100);
    }
}

class Bow extends Gun
{
    private int $specialDamage = 5;
}

class Crossbow extends Gun
{
    private int $specialDamage = 10;
}

class MagicStaff extends Gun
{
    private int $specialDamage = 20;
}

class Sword extends Gun
{
    private int $specialDamage = 30;
}

