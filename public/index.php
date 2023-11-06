<?php
use Julian\ToyRobotApp\ToyRobot\ToyRobot;
use Julian\ToyRobotApp\Generic\Table;
use Julian\ToyRobotApp\ToyRobot\ToyRobotCommandQueue;

$robot = new ToyRobot();
$table = new Table(5, 5);
$commandQueue = new ToyRobotCommandQueue($robot, $table);
$commandQueue->importCommandsFromFile($_SERVER['DOCUMENT_ROOT'] . '/inputs/test_long_sequence.txt');
$commandQueue->invokeCommands();