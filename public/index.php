<?php
use Julian\ToyRobot\CommandQueue;
use Julian\ToyRobot\ToyRobot;

$robot = new ToyRobot();
$commandQueue = new CommandQueue($robot);
$commandQueue->importFromFile($_SERVER['DOCUMENT_ROOT'] . '/inputs/test_commands.txt');
$commandQueue->execute();