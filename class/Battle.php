<?php
require_once 'class/Hero.php';
class Battle
{
    protected Hero $hero1;
    protected Hero $hero2;
    public function __construct(Hero $hero1, Hero $hero2)
    {
        $this->hero1 = $hero1;
        $this->hero2 = $hero2;
    }

    public function battle() :array|null
    {
        while ($this->hero1->getHealth() > 0 && $this->hero2->getHealth() > 0) {

            $damageToHero2 = $this->calculateDamage($this->hero1, $this->hero2);
            $this->hero2->takeDamage($damageToHero2);

            if ($this->hero2->getHealth() <= 0) {
                return ['winner' => $this->hero1, 'loser' => $this->hero2];
            }

            $damageToHero1 = $this->calculateDamage($this->hero2, $this->hero1);
            $this->hero1->takeDamage($damageToHero1);

            if ($this->hero1->getHealth() <= 0) {
                return ['winner' => $this->hero2, 'loser' => $this->hero1];
            }
        }

        return null;
    }

    protected function calculateDamage(Hero $attacker, Hero $defender): int
    {
        return max(0, $attacker->getDamage() - $defender->getArmor());
    }
}