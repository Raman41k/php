<?php
require_once 'class/Hero.php';
require_once 'class/Gun.php';
require_once 'class/Battle.php';

$bow = new Bow(20);
$crossbow = new Crossbow(35);
$magicStaff = new MagicStaff(50);
$sword = new Sword(10);

$warrior = new Warrior(100, 10);
$warrior->setGun($sword);

$magician = new Magician(100, 20);
$magician->setGun($magicStaff);

$archer = new Archer(100, 10);
$archer->setGun($crossbow);

$battle = new Battle($archer, $warrior);
$battleResult = $battle->battle();

$winner = $battleResult['winner'];
$looser = $battleResult['loser'];

echo $winner->sayOnWin() . PHP_EOL;
echo $looser->sayOnLose() . PHP_EOL;