<?php

use Julian\ToyRobotApp\Command\CommandInvoker;
use Julian\ToyRobotApp\Generic\Direction;
use Julian\ToyRobotApp\Generic\Table;
use Julian\ToyRobotApp\ToyRobot\LeftCommand;
use Julian\ToyRobotApp\ToyRobot\MoveCommand;
use Julian\ToyRobotApp\ToyRobot\PlaceCommand;
use Julian\ToyRobotApp\ToyRobot\ReportCommand;
use Julian\ToyRobotApp\ToyRobot\RightCommand;
use Julian\ToyRobotApp\ToyRobot\ToyRobot;
use Julian\ToyRobotApp\ToyRobot\ToyRobotCommandParser;
use Julian\ToyRobotApp\ToyRobot\ToyRobotCommandQueue;
use PHPUnit\Framework\TestCase;

final class ToyRobotTest extends TestCase
{
    function testRobotCanBePlacedOnTable()
    {
        $xPosition = 3;
        $yPosition = 3;
        $direction = Direction::NORTH;
        $robot = new ToyRobot();
        $table = new Table(5, 5);

        $command = new PlaceCommand($robot, $table, $xPosition, $yPosition, $direction);
        $command->execute();

        $this->assertEquals($robot->getXPosition(), $xPosition);
        $this->assertEquals($robot->getYPosition(), $yPosition);
        $this->assertEquals($robot->getDirection(), $direction);
    }

    function testRobotCanMoveOnTable()
    {
        $robot = new ToyRobot();
        $robot->setPosition(2, 2);
        $robot->setDirection(Direction::NORTH);

        $table = new Table(5, 5);

        $command = new MoveCommand($robot, $table);
        $command->execute();

        $this->assertEquals($robot->getYPosition(), 3);
    }

    function testRobotCanRotateLeft()
    {
        $robot = new ToyRobot();

        $robot->setDirection(Direction::NORTH);

        $command = new LeftCommand($robot);
        $command->execute();

        $this->assertEquals($robot->getDirection(), Direction::WEST);
    }

    function testRobotCanRotateRight()
    {
        $robot = new ToyRobot();

        $robot->setDirection(Direction::NORTH);

        $command = new RightCommand($robot);
        $command->execute();

        $this->assertEquals($robot->getDirection(), Direction::EAST);
    }

    function testRobotCanReport()
    {
        $robot = new ToyRobot();

        $robot->setPosition(3, 3);
        $robot->setDirection(Direction::NORTH);

        $command = new ReportCommand($robot);
        $command->execute();

        $this->expectOutputRegex("/Output: 3,3,NORTH/");
    }

    function testRobotIgnoresPlaceCommandIfPositionIsOffTable()
    {
        $robot = new ToyRobot();

        $invoker = new CommandInvoker();
        $invoker->invoke(
            new PlaceCommand(
                $robot,
                new Table(5, 5),
                10,
                10,
                Direction::NORTH
            )
        );

        $this->assertFalse($robot->hasBeenPlaced());
    }

    function testRobotIgnoresCommandsIfNotPlaced()
    {
        $robot = new ToyRobot();
        $table = new Table(5, 5);

        $queue = new ToyRobotCommandQueue($robot, $table);
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("LEFT");
        $queue->addCommandFromString("RIGHT");
        $queue->addCommandFromString("REPORT");
        $queue->invokeCommands();

        $this->assertEquals($queue->getCommandsExecuted(), 0);
    }

    function testRobotIgnoresMoveCommandIfDestinationIsOffTableInAnyDirection() {
        $robot = new ToyRobot();
        $table = new Table(5, 5);

        $queue = new ToyRobotCommandQueue($robot, $table);
        $queue->addCommandFromString("PLACE 3,3,NORTH");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("REPORT");
        $queue->invokeCommands();
        $this->assertEquals($robot->getXPosition(), 3);
        $this->assertEquals($robot->getYPosition(), 5);
        $this->assertEquals($robot->getDirection(), Direction::NORTH);

        $queue = new ToyRobotCommandQueue($robot, $table);
        $queue->addCommandFromString("PLACE 3,3,SOUTH");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("REPORT");
        $queue->invokeCommands();
        $this->assertEquals($robot->getXPosition(), 3);
        $this->assertEquals($robot->getYPosition(), 1);
        $this->assertEquals($robot->getDirection(), Direction::SOUTH);

        $queue = new ToyRobotCommandQueue($robot, $table);
        $queue->addCommandFromString("PLACE 3,3,EAST");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("REPORT");
        $queue->invokeCommands();
        $this->assertEquals($robot->getXPosition(), 5);
        $this->assertEquals($robot->getYPosition(), 3);
        $this->assertEquals($robot->getDirection(), Direction::EAST);

        $queue = new ToyRobotCommandQueue($robot, $table);
        $queue->addCommandFromString("PLACE 3,3,WEST");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("REPORT");
        $queue->invokeCommands();
        $this->assertEquals($robot->getXPosition(), 1);
        $this->assertEquals($robot->getYPosition(), 3);
        $this->assertEquals($robot->getDirection(), Direction::WEST);

    }

    function testRobotExecutesNewCommandsAfterIgnoringMoveCommand() {
        $robot = new ToyRobot();
        $table = new Table(5, 5);

        $queue = new ToyRobotCommandQueue($robot, $table);
        $queue->addCommandFromString("PLACE 3,3,NORTH");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("RIGHT");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("MOVE");
        $queue->addCommandFromString("REPORT");
        $queue->invokeCommands();

        $this->assertEquals($robot->getXPosition(), 5);
        $this->assertEquals($robot->getYPosition(), 5);
        $this->assertEquals($robot->getDirection(), Direction::EAST);
    }

    function testRobotCanBePlacedMultipleTimes() {
        $robot = new ToyRobot();
        $table = new Table(5, 5);

        $parser = new ToyRobotCommandParser($robot, $table);
        $placeCommand1 = $parser->parse("PLACE 3,3,NORTH");
        $placeCommand2 = $parser->parse("PLACE 2,5,EAST");
        $placeCommand3 = $parser->parse("PLACE 4,1,WEST");

        $invoker = new CommandInvoker();
        $invoker->invoke($placeCommand1);
        $this->assertEquals($robot->getXPosition(), 3);
        $this->assertEquals($robot->getYPosition(), 3);
        $this->assertEquals($robot->getDirection(), Direction::NORTH);

        $invoker->invoke($placeCommand2);
        $this->assertEquals($robot->getXPosition(), 2);
        $this->assertEquals($robot->getYPosition(), 5);
        $this->assertEquals($robot->getDirection(), Direction::EAST);

        $invoker->invoke($placeCommand3);
        $this->assertEquals($robot->getXPosition(), 4);
        $this->assertEquals($robot->getYPosition(), 1);
        $this->assertEquals($robot->getDirection(), Direction::WEST);
    }
}