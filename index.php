<?php
require_once 'class/Hero.php';
require_once 'class/Gun.php';
require_once 'class/Battle.php';

$bow = new Bow(20);
$crossbow = new Crossbow(35);
$magicStaff = new MagicStaff(50);
$sword = new Sword(10);

$warrior = new Warrior(100, 10, $sword);
$magician = new Magician(100, 20, $magicStaff);
$archer = new Archer(100, 10, $crossbow);

$battle = new Battle($archer, $warrior);
$winner = $battle->battle();

print_r($winner);