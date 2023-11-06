<?php
use Julian\ToyRobot\CommandQueue;
use Julian\ToyRobot\Table;
use Julian\ToyRobot\ToyRobot;

$robot = new ToyRobot();
$table = new Table(5, 5);
$commandQueue = new CommandQueue($robot, $table);
$commandQueue->invokeCommands();